@extends('layouts.main')
@section('page-title', 'Buildings')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
{{-- Stay --}}
@else
{{ Session::flash('error','You are not permited to view that page') }}
<script>
  window.location.href = "{{ url('/dashboard') }}";
</script>
@endif
@section('content')
    <div class="card card-body blur shadow-blur overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">

            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Talents Buildings

                    </h5>

                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-12 my-5">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-3 d-flex align-items-center">
                            <h6 class="mb-0">Buildings</h6>
                        </div>
                        <div class="col-9 text-end">
                            <button class="btn btn-outline-info btn-sm mb-0" data-toggle="modal"
                                data-target="#new-building">Create New</button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-3 pb-0">
                    <div class="table-responsive p-0">
                        <table id="building-table" class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name</th>
                                    
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buildings as $building)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $building->name }}</p>
                                        </td>
                                       
                                        <td class="align-right text-right">
                                            <a href="/delete_building/{{ $building->id }}" style="float:right;"
                                                type="button" class="btn btn-danger btn-sm mb-0">Delete</a>
                                        </td>
                                        <!-- <td class="align-middle">
                                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                          </a>
                                                </td> -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="modal fade" id="new-building" tabindex="-1" role="dialog" aria-labelledby="new-buildings"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card shadow ">
                                    <div class="card-header  p-3">
                                        <h6 class="mb-0">Create Buildings</h6>
                                        <button type="button" class="btn-close text-dark" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>
                                    <div class="card-body p-3 pt-0">
                                        <ul class="list-group">
                                            <form action="create_building" method="post"> @csrf
                                                <div class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                        class="text-dark">Buildings Name:</strong> &nbsp;
                                                    <input class="form-control" type="text" name="name"
                                                         id="">
                                                </div>

                                               
                                                <div class="list-group-item border-0 ps-0 pt-0 text-sm">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <button type="submit"
                                                            class="btn btn-info mb-0 btn-block">submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
    @endsection
    @section('script')
        <script>
            // Limit user from selecting more than one amenities
            $(document).ready(function() {
                $("input[name='amenities[]']").change(function() {
                    var maxAllowed = 10;
                    var cnt = $("input[name='amenities[]']:checked").length;
                    if (cnt > maxAllowed) {
                        $(this).prop("checked", "");

                        $('#amenities-error').attr({
                            "class": "text-danger",
                            "role": "alert"
                        });
                    }
                });
                $('#building-table').DataTable({
                "paging": true,
                "pagingType": "full_numbers",
                "language": {
                    "paginate": {
                        "previous": "‹",
                        "first": "«",
                        "next": "›",
                        "last": "»",
                    }
                },
                "retrieve": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                "responsive": false,
               "buttons": {
                    "buttons": ["csv", "excel", "pdf", "print"],
                     "dom": {
                    "container": {
                        "tag": "div",
                        "className": "text-end align-items-right"
                    },
                    "collection": {
                        "tag": "div",
                        "className": ""
                    },
                    "button": {
                        "tag": "button",
                        "className": "btn btn-sm bg-gradient-primary",
                        "active": "active",
                        "disabled": "disabled"
                    },
                    
                }
                },
                "info": false,
               
                
            }).buttons().container().appendTo('#building-table-data');

            });
        </script>
    @endsection
