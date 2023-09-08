@php
function daysCount(DateTime $past_date){
    //set current date
    $now = new DateTime;
	//get differ between past date date and current date
    $diff = $now->diff($past_date);

    if ($past_date > $now) 
        return 'future';
        
    $total_days = $diff->days;
    $total_months = ($diff->y * 12) + $diff->m;
    $total_years = $diff->y;

    //setup of localization if you want to use another language, PHP will translate it
	setlocale(LC_ALL, 'en_EN');
	
    $count = ($d = $diff->d) ? ' and '. $d . ngettext(" day", " days", $d) : '';
    $count = ($m = $diff->m) ? ($count ? ', ' : ' and '). $m . ngettext(" month", " months", $m).$count : $count;
    $count = ($y = $diff->y) ? $y . ngettext(" year", " years", $y).$count  : $count;
            
    return $count;
}
@endphp

@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('page-title', $lawyer->first_name . ' ' . $lawyer->last_name)
@section('content')

    <div class="row mt-4">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center border-bottom py-3">
                    <div class="d-flex align-items-center">
                        <a href="javascript:;">
                            <img src="{{ $lawyer->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}" class="avatar"
                                alt="profile-image">
                        </a>
                        <div class="mx-3">
                            <a href="javascript:;" class="text-dark text-s h5">{{ $lawyer->first_name }}
                                {{ $lawyer->last_name }} <small class="d-block text-muted text-xs"> Last login
                                    {{ \Carbon\Carbon::parse($last_login)->format('d/m/Y - h:i a') }}

                                </small>
                            </a>

                            <a href="/lawyer/{{ $lawyer->id }}/login-reports" class="text-primary text-sm m-0 p-0">
                                Login Report
                            </a>
                        </div>
                    </div>
                    <div class="text-end ms-auto">
                        @if ($lawyer->phone_number)
                            <a href="tel:{{ $lawyer->phone_number }}" class="btn btn-sm bg-gradient-primary mb-0">
                                <i class="fas fa-phone pe-2"></i> Call
                            </a>
                        @endif

                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0"><strong class="text-dark">Full Name:</strong> &nbsp;
                            {{ $lawyer->first_name }} {{ $lawyer->middle_name }} {{ $lawyer->last_name }}</li>
                        <li class="list-group-item border-0 ps-0 pt-0">
                            <hr class="ps-0 pt-0 m-0 horizontal dark">
                        </li>
                        <li class="list-group-item border-0 ps-0"><strong class="text-dark">Mobile:</strong> &nbsp;
                            {{ $lawyer->phone_number }}</li>
                        <li class="list-group-item border-0 ps-0 pt-0">
                            <hr class="ps-0 pt-0 m-0 horizontal dark">
                        </li>
                        <li class="list-group-item border-0 ps-0"><strong class="text-dark">Email:</strong> &nbsp;
                            {{ $lawyer->email }}</li>
                        <li class="list-group-item border-0 ps-0 pt-0">
                            <hr class="ps-0 pt-0 m-0 horizontal dark">
                        </li>
                        <li class="list-group-item border-0 ps-0"><strong class="text-dark">Location:</strong> &nbsp;
                            {{ $lawyer->street }}, {{ $lawyer->city }}, {{ $lawyer->state }}</li>
                        <li class="list-group-item border-0 ps-0"><strong class="text-dark">Count of Days:</strong> &nbsp;
                            @if (daysCount(\Carbon\Carbon::parse($lawyer->lawyer->start_date)) == 'future')
                               Start on {{ \Carbon\Carbon::parse($lawyer->lawyer->start_date) }}
                            @else
                               {{ daysCount(\Carbon\Carbon::parse($lawyer->lawyer->start_date)) }}
                            @endif
                            {{-- {{ daysCount(new DateTime('1998-09-28')) }} --}}
                        </li>

                    </ul>

                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Reports</h5>
                            <p class="text-sm mb-0">
                                {{-- COunt: {{$lawyers->count()}} --}}
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
          
                             @if ($reports->count() !== 0)
                                    <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                                        type="button" name="button">Export</button>
                                @endif
          
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table id="report-table"  class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Documents</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Residents</th>
                              {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Position</th> --}}
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Names</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stamp</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Signature</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($reports as $report)
                              <tr>
                                  <td>
                                    <div class="d-flex px-2 py-1">
                                     
                                      
                                      <div class="d-flex flex-column justify-content-center">
                                        <a href="{{ asset($report->document->document_path) }}">
                                        <h6 class="mb-0 text-sm">
                                          {{ $report->document->title ?? ''}}
                                          
                                        </h6>
                                      </a>
                                      </div>
                                    
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex px-2 py-1">
                                     
                                        <div>
                                          <img src="{{ $report->user->photo ?? asset('assets/img/no-pics-placeholder.jpg')}}" class="avatar avatar-sm me-3" alt="avatar image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                          <a href="/resident/{{ $report->user->id ?? ''}}">
                                          <h6 class="mb-0 text-sm">
                                            {{ $report->user->first_name ?? ''}}
                                            {{ $report->user->middle_name ?? ''}}
                                            {{ $report->user->last_name ?? ''}}
                                            
                                          </h6>
                                        </a>
                                        </div>
                                      
                                      </div>
                                  </td>
                                  {{-- <td>
                                    <span class="badge badge-dot me-4">
                                      <i class="bg-info"></i>
                                      <span class="text-dark text-xs">{{ $lawyer->position ?? ''}}</span>
                                    </span>
                                  </td> --}}
                                  <td class="align-middle text-center text-sm">
                                    <p class="text-secondary mb-0 text-sm">{{ $report->names ? count(json_decode($report->names)) : 0}}</p>
                                  </td>
                                  <td class="align-middle text-center">
                                    <span class="text-secondary text-sm">{{ $report->stamps ? count(json_decode($report->stamps)) : 0}}</span>
                                  </td>
                                  <td class="align-middle text-center">
                                    <span class="text-secondary text-sm">{{ $report->signatures ? count(json_decode($report->signatures)) : 0}}</span>
                                  </td>
                                </tr>  
                              @endforeach
                            
                            
                          </tbody>
                        </table>
                      </div>
                </div>
            </div>
            
        </div>
        <div class="col-12 col-lg-4">
            <div class="card mb-3 mt-lg-0 mt-4">
                <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="avatar avatar-lg">
                            <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            {{-- <img alt="Image placeholder" src="../../../assets/img/small-logos/logo-slack.svg"> --}}
                        </div>
                        <div class="ms-2 my-auto">
                            <h6 class="mb-0">{{ $lawyer->roles()->first()->name }}</h6>
                            <p class="text-xs mb-0">{{ $lawyer->roles()->first()->permissions->count() }} permission</p>
                        </div>
                    </div>
                    <p class="mt-3">
                        This user has been assigned the role of
                        <strong>{{ $lawyer->roles()->first()->name }}</strong>
                        {{-- {{$user_roles_permissions}} --}}
                        with {{ count($lawyer->permissions) }} extra permisions
                    </p>
                    <hr class="horizontal dark">
                    <div class="text-center">
                        <a href="/lawyer/{{ $lawyer->id ?? '' }}/permissions" class="btn btn-sm bg-gradient-dark mb-0">
                            Update Permission
                        </a>

                    </div>
                </div>
            </div>
            <div class="card mt-4">

                <div class="card-body">
                    <div class="row align-items-center mb-3">
                        <div class="col-9">
                            <h5 class="mb-1">
                                <a href="javascript:;">Salary</a>
                            </h5>
                        </div>
                    </div>
                    <div class="row">

                        <form action="/lawyer/{{ $lawyer->id }}/update" method="POST">
                            @csrf
                            {{-- <div class="col-12">
                                <label class="form-label">Position</label>
                                <div class="input-group">
                                    <input id="position" name="position" class="form-control" type="text"
                                        value="{{ $lawyer->lawyer->position ?? '' }}">
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <label class="form-label">Amount</label>
                                <div class="input-group">
                                    <input id="salary" name="salary" class="form-control" type="text"
                                        value="{{ $lawyer->lawyer->salary ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12 mt-3">

                                <button class="btn btn-sm bg-gradient-dark mb-0" type="submit">
                                    Update
                                </button>

                                <button class="btn btn-sm bg-gradient-danger mb-0" type="button"
                                    id="delete-lawyer-button">
                                    Delete Lawyer
                                </button>
                            </div>
                        </form>

                        <form action="/lawyer/{{ $lawyer->id }}" method="POST" id="delete-lawyer">
                            @method('Delete')
                            @csrf




                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#delete-lawyer-button").click(function() {
                const suggestedButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn bg-gradient-danger mx-1',
                        cancelButton: 'btn bg-gradient-dark mx-1'
                    },
                    buttonsStyling: false
                })

                suggestedButtons.fire({
                    icon: 'warning',
                    title: 'Delete?',
                    text: 'Are you sure you want to delete this lawyer',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, continue!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $("#delete-lawyer").submit()
                        // this.form.submit()
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        //   swalWithBootstrapButtons.fire(
                        //     'Cancelled',
                        //     'Your imaginary file is safe :)',
                        //     'error'
                        //   )
                    }
                })
                // alert('jhg')
            });

            if (document.getElementById('report-table')) {
            const dataTableSearch = new simpleDatatables.DataTable("#report-table", {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                paging: true,
                ordering: false,
                info: false,
                lengthChange: true,
                perPageSelect: [1, 5, 10, 15, 20, 25],
                labels: {
                    placeholder: "Search...",
                    perPage: "{select} entries per page",
                    noRows: "No entries found",
                    info: "Showing {start} to {end} of {rows} entries"
                },
                layout: {
                    top: "{select}{search}",
                    bottom: "{info}{pager}"
                },
                // "autoWidth": false,
                "responsive": true,
            });

            document.querySelectorAll(".export").forEach(function(el) {
                el.addEventListener("click", function(e) {
                    var type = el.dataset.type;

                    var data = {
                        type: type,
                        filename: "lawyer-{{ $lawyer->first_name }}-{{ $lawyer->last_name }}-report-" +
                            type,
                    };

                    if (type === "csv") {
                        data.columnDelimiter = "|";
                    }

                    dataTableSearch.export(data);
                });
            });
        };


        });
    </script>

@endsection
