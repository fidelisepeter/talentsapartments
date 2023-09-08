@extends('layouts.main')
@if (Auth::user()->role == 'student')
<script>
    window.location.href = "{{ url('/profile') }}";
</script>
@endif
@section('page-title', 'Departments')
@section('content')
    
<div class="row">
    
    <div class="col-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-lg-flex">
              <div>
                  <h5 class="mb-0">Department</h5>
                  <p class="text-sm mb-0">
                      {{-- COunt: {{$departments->count()}} --}}
                  </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                  <div class="ms-auto my-auto">

                    <a class="btn bg-gradient-primary btn-sm export mb-0 mt-sm-0 mt-1" href="/department/create">Create New Department</a>
                      @if ($departments->count() !== 0)
                          <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                              type="button" name="button">Export</button>
                      @endif

                  </div>
              </div>
          </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive">
            <table id="department-table"  class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Staffs</th>
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date uploaded</th> --}}
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th> --}}
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                    <tr>
                        <td>
                            <h6 class="mb-0 text-sm">
                                {{ $department->name ?? ''}}
                                
                              </h6>
                        </td>

                        <td class="align-middle text-center text-sm">
                            <p class="text-secondary mb-0 text-sm">{{ $department->description ?? ''}}</p>
                          </td>
                       
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    @php
                                        
                                        $max = 5;
                                        $total = $department->staff()->count();
                                        $sub = $total - $max;
                                        $counter = $sub > 0 ? '+ ' . $sub . ' more' : '';
                                        
                                    @endphp
                                    @forelse($department->staff()->get() as $staff)
                                    
                                        <a href="/staff/{{ $staff->get->id ?? '' }}"
                                            class="avatar avatar-xs rounded-circle" data-toggle="tooltip"
                                            data-original-title="{{ $staff->get->first_name }} {{ $staff->get->last_name }}"
                                            title="{{ $staff->get->first_name }} {{ $staff->get->last_name }}">
                                            <img alt="/"
                                                src="{{ $staff->get->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                                                class="">
                                        </a>
                                       
                                    @empty

                                        <span class="text-dark text-xs">No Staff assigned</span>
                                    @endforelse

                                </div>
                                <small class="ps-2 font-weight-bold">{{ $counter }}</small>
                            </div>
                        </td>

                        <td class="align-middle text-center">
                            <div class="d-flex align-items-center">
                                <a class="text-dark text-sm mx-3" href="/department/{{ $department->id }}"> Update </a>
                                <a class="text-danger text-sm mx-3" href="/department/{{ $department->id }}/delete"> Delete</a>
                               
                            </div>
                          <span class="text-secondary text-sm"></span>
                        </td>
                      </tr>  
                    @endforeach
                  
                  
                </tbody>
              </table>
        </div>
      </div>
      </div>
    </div>
  </div>
  


    @endsection
    @section('script')
    <script>
        // Limit user from selecting more than one department
        $(document).ready(function() {
            $("input[name='department[]']").change(function() {
                var maxAllowed = 10;
                var cnt = $("input[name='department[]']:checked").length;
                if (cnt > maxAllowed) {
                    $(this).prop("checked", "");

                    $('#department-error').attr({
                        "class": "text-danger",
                        "role": "alert"
                    });
                }
            });
            $('#department-tables').DataTable({
            
           
            
        }).buttons().container().appendTo('#department-table-data');


        if (document.getElementById('department-table')) {
            const dataTableSearch = new simpleDatatables.DataTable("#department-table", {
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
                        filename: "departments-talentapartment-" +
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
