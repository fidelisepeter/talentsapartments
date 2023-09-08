@extends('layouts.main')
@section('page-title', 'Locations')
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
                        Talents Room Locations

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
                            <h6 class="mb-0">Locations</h6>
                        </div>
                        <div class="col-9 text-end">
                            <button class="btn btn-outline-info btn-sm mb-0" data-toggle="modal"
                                data-target="#new-location">Create New</button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-3 pb-0">
                    <div class="table-responsive p-0">
                        <table id="location-table" class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        State</th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $location)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $location->name }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{ $location->state }}</p>
                                        </td>
                                        <td class="align-right text-right">
                                            <a href="/delete_location/{{ $location->id }}" style="float:right;"
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
        <div class="modal fade" id="new-location" tabindex="-1" role="dialog" aria-labelledby="new-location"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card shadow ">
                                    <div class="card-header  p-3">
                                        <h6 class="mb-0">Create Locations</h6>
                                        <button type="button" class="btn-close text-dark" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>
                                    <div class="card-body p-3 pt-0">
                                        <ul class="list-group">
                                            <form action="create_location" method="post"> @csrf
                                                <div class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                        class="text-dark">Location Name:</strong> &nbsp;
                                                    <input class="form-control" type="text" name="name"
                                                        placeholder="eg Ibadan" id="">
                                                </div>

                                                <div class="list-group-item border-0 ps-0 pt-0 text-sm">
                                                    <input class="form-control" type="text" name="area"
                                                        placeholder="Area" id="">
                                                </div>

                                                <div class="list-group-item border-0 ps-0 pt-0 text-sm">
                                                    <select class="form-control" name="state">
                                                        <option disabled selected>--Select State--</option>
                                                        <option value="Abia">Abia</option>
                                                        <option value="Adamawa">Adamawa</option>
                                                        <option value="Akwa Ibom">Akwa Ibom</option>
                                                        <option value="Anambra">Anambra</option>
                                                        <option value="Bauchi">Bauchi</option>
                                                        <option value="Bayelsa">Bayelsa</option>
                                                        <option value="Benue">Benue</option>
                                                        <option value="Borno">Borno</option>
                                                        <option value="Cross Rive">Cross River</option>
                                                        <option value="Delta">Delta</option>
                                                        <option value="Ebonyi">Ebonyi</option>
                                                        <option value="Edo">Edo</option>
                                                        <option value="Ekiti">Ekiti</option>
                                                        <option value="Enugu">Enugu</option>
                                                        <option value="FCT">Federal Capital Territory</option>
                                                        <option value="Gombe">Gombe</option>
                                                        <option value="Imo">Imo</option>
                                                        <option value="Jigawa">Jigawa</option>
                                                        <option value="Kaduna">Kaduna</option>
                                                        <option value="Kano">Kano</option>
                                                        <option value="Katsina">Katsina</option>
                                                        <option value="Kebbi">Kebbi</option>
                                                        <option value="Kogi">Kogi</option>
                                                        <option value="Kwara">Kwara</option>
                                                        <option value="Lagos">Lagos</option>
                                                        <option value="Nasarawa">Nasarawa</option>
                                                        <option value="Niger">Niger</option>
                                                        <option value="Ogun">Ogun</option>
                                                        <option value="Ondo">Ondo</option>
                                                        <option value="Osun">Osun</option>
                                                        <option value="Oyo">Oyo</option>
                                                        <option value="Plateau">Plateau</option>
                                                        <option value="Rivers">Rivers</option>
                                                        <option value="Sokoto">Sokoto</option>
                                                        <option value="Taraba">Taraba</option>
                                                        <option value="Yobe">Yobe</option>
                                                        <option value="Zamfara">Zamfara</option>
                                                    </select>
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
                $('#location-table').DataTable({
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
               
                
            }).buttons().container().appendTo('#location-table-data');

            });
        </script>
    @endsection
