@extends('layouts.main')
@if (Auth::user()->role == 'student')
<script>
    window.location.href = "{{ url('/profile') }}";
</script>
@endif
@section('page-title', 'Users')
@section('content')
    
<div class="row">
    
    <div class="col-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-lg-flex">
              <div>
                  <h5 class="mb-0">User</h5>
                  <p class="text-sm mb-0">
                      {{-- COunt: {{$residents->count()}} --}}
                  </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                  <div class="ms-auto my-auto">

                    {{-- <a class="btn bg-gradient-primary btn-sm export mb-0 mt-sm-0 mt-1" href="/document/create">Create New User</a>
                      @if ($residents->count() !== 0)
                          <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                              type="button" name="button">Export</button>
                      @endif --}}

                  </div>
              </div>
          </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive">
            <table id="user-table"  class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Documents</th>
                    
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. of Document Pending</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. of Document Completed</th>
                </thead>
                <tbody>
                    
                    @foreach ($residents as $resident)
                    @php

                        $count_of_documents = count($documents);
                        
                        $count_of_completed_documents = $resident->user->signed_documents->where('lawyer_id', Auth::id())->where('signatures_status', 'completed')->where('stamps_status', 'completed')->where('names_status', 'completed')->count();
                        $count_of_pending_documents = ($count_of_documents-$count_of_completed_documents);

                        
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                             
                              <div>
                                <img src="{{ $resident->user->photo ?? asset('assets/img/no-pics-placeholder.jpg')}}" class="avatar avatar-sm me-3" alt="avatar image">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <a href="/document/user/{{ $resident->user->id ?? ''}}">
                                <h6 class="mb-0 text-sm">
                                  {{ $resident->user->first_name ?? ''}}
                                  {{ $resident->user->middle_name ?? ''}}
                                  {{ $resident->user->last_name ?? ''}}
                                </h6>
                              </a>
                              </div>
                            
                            </div>
                          </td>
                          <td>
                            <p class="text-sm text-secondary mb-0">{{ $count_of_documents }}</p>
                          </td>
                        <td>
                          <p class="text-sm text-secondary mb-0">{{ $count_of_pending_documents }}</p>
                        </td>
                        <td>
                            <p class="text-sm text-secondary mb-0">{{ $count_of_completed_documents }}</p>
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
        // Limit user from selecting more than one user
        $(document).ready(function() {
            $("input[name='user[]']").change(function() {
                var maxAllowed = 10;
                var cnt = $("input[name='user[]']:checked").length;
                if (cnt > maxAllowed) {
                    $(this).prop("checked", "");

                    $('#user-error').attr({
                        "class": "text-danger",
                        "role": "alert"
                    });
                }
            });
            $('#user-tables').DataTable({
            
           
            
        }).buttons().container().appendTo('#user-table-data');


        if (document.getElementById('user-table')) {
            const dataTableSearch = new simpleDatatables.DataTable("#user-table", {
                searchable: true,
                fixedHeight: false,
                perPage: 5,
                paging: true,
                ordering: false,
                info: false,
                lengthChange: true,
                perPageSelect: [5, 10, 15, 20, 25],
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
                        filename: "users-talentapartment-" +
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
