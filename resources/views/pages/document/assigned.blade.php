@extends('layouts.main')
@if (Auth::user()->role == 'student')
<script>
    window.location.href = "{{ url('/profile') }}";
</script>
@endif
@section('page-title', 'My Assigned Documents')
@section('content')
    
<div class="row">
    
    <div class="col-12 mt-4">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-lg-flex">
                <div>
                    <h5 class="mb-0">Document</h5>
                    <p class="text-sm mb-0">
                        {{-- COunt: {{$documents->count()}} --}}
                    </p>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">
  
                    
  
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive">
              <table id="document-table"  class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                      {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Assigned To</th> --}}
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date uploaded</th>
                      {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th> --}}
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach (Auth::user()->lawyer->documents() as $document)
                      <tr>
                          <td>
                              <h6 class="mb-0 text-sm">
                                  {{ $document->title ?? ''}}
                                  
                                </h6>
                          </td>
                          <td>
                            <p class="text-sm text-secondary mb-0">{{ $document->type ?? ''}}</p>
                          </td>
                          
                          <td class="align-middle text-center text-sm">
                            <p class="text-secondary mb-0 text-sm">{{ $document->created_at ?? ''}}</p>
                          </td>
                          <td class="align-middle text-center">
                            <div class="d-flex align-items-center">
                                <a class="text-dark text-sm mx-3" href="{{ asset($document->document_path) }}"> View Document</a>
                               
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
  </div>
  


    @endsection
    @section('script')
    <script>
        // Limit user from selecting more than one document
        $(document).ready(function() {
            $("input[name='document[]']").change(function() {
                var maxAllowed = 10;
                var cnt = $("input[name='document[]']:checked").length;
                if (cnt > maxAllowed) {
                    $(this).prop("checked", "");

                    $('#document-error').attr({
                        "class": "text-danger",
                        "role": "alert"
                    });
                }
            });
            $('#document-tables').DataTable({
            
           
            
        }).buttons().container().appendTo('#document-table-data');


        if (document.getElementById('document-table')) {
            const dataTableSearch = new simpleDatatables.DataTable("#document-table", {
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
                        filename: "documents-talentapartment-" +
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
