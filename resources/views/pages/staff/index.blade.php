@extends('layouts.main')
@if (Auth::user()->role == 'student')
<script>
    window.location.href = "{{ url('/profile') }}";
</script>
@endif
@section('page-title', 'Staffs')
@section('content')
    
<div class="row">
    
    <div class="col-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-lg-flex">
              <div>
                  <h5 class="mb-0">Staff</h5>
                  <p class="text-sm mb-0">
                      {{-- COunt: {{$staffs->count()}} --}}
                  </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                  <div class="ms-auto my-auto">

                    <a class="btn bg-gradient-primary btn-sm export mb-0 mt-sm-0 mt-1" href="/staff/create">Create New Staff</a>
                      @if ($staffs->count() !== 0)
                          <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                              type="button" name="button">Export</button>
                      @endif

                  </div>
              </div>
          </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive">
          <table id="staff-table"  class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Position</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Salary</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($staffs as $staff)
                <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                       
                        <div>
                          <img src="{{ $staff->get->photo ?? asset('assets/img/no-pics-placeholder.jpg')}}" class="avatar avatar-sm me-3" alt="avatar image">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <a href="/staff/{{ $staff->get->id ?? ''}}">
                          <h6 class="mb-0 text-sm">
                            {{ $staff->get->first_name ?? ''}}
                            {{ $staff->get->middle_name ?? ''}}
                            {{ $staff->get->last_name ?? ''}}
                          </h6>
                        </a>
                        </div>
                      
                      </div>
                    </td>
                    <td>
                      <p class="text-sm text-secondary mb-0">{{ $staff->get->roles()->first()->name ?? ''}}</p>
                    </td>
                    <td>
                      <span class="badge badge-dot me-4">
                        <i class="bg-info"></i>
                        <span class="text-dark text-xs">{{ $staff->position ?? ''}}</span>
                      </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-secondary mb-0 text-sm">{{ $staff->get->email ?? ''}}</p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-sm">{{ $staff->start_date ?? ''}}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-sm">{{ $staff->salary ?? ''}}</span>
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
        // Limit user from selecting more than one staff
        $(document).ready(function() {
            $("input[name='staff[]']").change(function() {
                var maxAllowed = 10;
                var cnt = $("input[name='staff[]']:checked").length;
                if (cnt > maxAllowed) {
                    $(this).prop("checked", "");

                    $('#staff-error').attr({
                        "class": "text-danger",
                        "role": "alert"
                    });
                }
            });
            $('#staff-tables').DataTable({
            
           
            
        }).buttons().container().appendTo('#staff-table-data');


        if (document.getElementById('staff-table')) {
            const dataTableSearch = new simpleDatatables.DataTable("#staff-table", {
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
                        filename: "staffs-talentapartment-" +
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
