@extends('layouts.main')
@if (Auth::user()->role == 'student')
<script>
    window.location.href = "{{ url('/profile') }}";
</script>
@endif
@section('page-title', 'Lawyers')
@section('content')
    
<div class="row">
    
    <div class="col-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-lg-flex">
              <div>
                  <h5 class="mb-0">Lawyer</h5>
                  <p class="text-sm mb-0">
                      {{-- COunt: {{$lawyers->count()}} --}}
                  </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                  <div class="ms-auto my-auto">

                    <a class="btn bg-gradient-primary btn-sm export mb-0 mt-sm-0 mt-1" href="/lawyer/create">Create New Lawyer</a>
                      @if ($lawyers->count() !== 0)
                          <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                              type="button" name="button">Export</button>
                      @endif

                  </div>
              </div>
          </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive">
          <table id="lawyer-table"  class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Position</th> --}}
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Salary</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($lawyers as $lawyer)
                <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                       
                        <div>
                          <img src="{{ $lawyer->get->photo ?? asset('assets/img/no-pics-placeholder.jpg')}}" class="avatar avatar-sm me-3" alt="avatar image">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <a href="/lawyer/{{ $lawyer->get->id ?? ''}}">
                          <h6 class="mb-0 text-sm">
                            {{ $lawyer->name() ?? ''}}
                            
                          </h6>
                        </a>
                        </div>
                      
                      </div>
                    </td>
                    <td>
                      <p class="text-sm text-secondary mb-0">Lawyer</p>
                    </td>
                    {{-- <td>
                      <span class="badge badge-dot me-4">
                        <i class="bg-info"></i>
                        <span class="text-dark text-xs">{{ $lawyer->position ?? ''}}</span>
                      </span>
                    </td> --}}
                    <td class="align-middle text-center text-sm">
                      <p class="text-secondary mb-0 text-sm">{{ $lawyer->get->email ?? ''}}</p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-sm">{{ $lawyer->start_date ?? ''}}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-sm">{{ $lawyer->salary ?? ''}}</span>
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
        // Limit user from selecting more than one lawyer
        $(document).ready(function() {
            $("input[name='lawyer[]']").change(function() {
                var maxAllowed = 10;
                var cnt = $("input[name='lawyer[]']:checked").length;
                if (cnt > maxAllowed) {
                    $(this).prop("checked", "");

                    $('#lawyer-error').attr({
                        "class": "text-danger",
                        "role": "alert"
                    });
                }
            });
            $('#lawyer-tables').DataTable({
            
           
            
        }).buttons().container().appendTo('#lawyer-table-data');


        if (document.getElementById('lawyer-table')) {
            const dataTableSearch = new simpleDatatables.DataTable("#lawyer-table", {
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
                        filename: "lawyers-talentapartment-" +
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
