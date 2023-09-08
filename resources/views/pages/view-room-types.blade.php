@extends('layouts.main')
@section('page-title', 'Rooms')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
    {{-- Stay --}}
@else
    {{ Session::flash('error', 'You are not permited to view that page') }}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@section('content')

    <div class="row">
        <div class="col-12 col-sm-8 m-auto mt-4">
            <div class="card shadow border-0 mb-0 p-3">

                <div class="card-body p-3">
                    <form method="POST" action="/room-types/{{ $room->id }}/update" enctype="multipart/form-data">@csrf
                        <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                            Room Name</h6>
                        <ul class="list-group">
                            <div class="mt-0 border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input  placeholder="eg Deluxe" class="form-input ms-auto form-control"
                                        type="text" name="name" value="{{ $room->name }}">
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-8 mb-4">

                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                        Room Types</h6>

                                    <div class="mt-0 border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                            <select class="form-control" name="location">
                                                <option disabled selected>--Select Location--
                                                </option>
                                                @foreach (DB::table('locations')->get() as $location)
                                                    <option @if ($location->id == $room->location)
                                                        selected
                                                    @endif 
                                                    value="{{ $location->id }}">
                                                        {{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                </div>

                                <div class="col-md-4 mb-4">

                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                        Room Price</h6>

                                    <div class="mt-0 border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                            <input  class="form-input ms-auto form-control" placeholder="500"
                                                type="text" name="price" value="{{ $room->price }}">
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                Room Amenities</h6>
                            <small id="amenities-error" class="d-none"> You can only select 10
                                Amenities
                            </small>

                            <div class="mt-0 border-0 ps-0 pt-0 text-sm">
                                <div class="ow mx-1">
                                    @foreach (DB::table('amenities')->get() as $amenities)
                                        <div class="form-check-inline p-0">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input id="amenities" type="checkbox" name="amenities[]"
                                                        class="form-check-input "
                                                        @if (in_array($amenities->id, [$room->amenity1, $room->amenity2, $room->amenity3, $room->amenity4, $room->amenity5, $room->amenity6, $room->amenity7, $room->amenity8, $room->amenity9, $room->amenity10]))
                                                        checked
                                                    @endif 
                                                        value="{{ $amenities->id }}">{{ $amenities->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                                <!-- <select multiple class=" form-control" name="amenities[]">
                                        <option disabled selected>--Select Amenities--
                                        </option>
                                        @foreach (DB::table('amenities')->get() as $amenities)
    <option value="{{ $amenities->id }}">
                                            {{ $amenities->name }}</option>
    @endforeach
                                    </select> -->
                            </div>
                            <div class="row">

                            </div>



                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                Room Photo</h6>

                            <div class="mt-0 border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-input ms-auto form-control" placeholder="500" type="file"
                                        name="photo" id="">
                                </div>
                            </div>


                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                Room Detail</h6>

                            <div class="mt-0 border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <textarea  class="form-control" placeholder="say something about the room" name="detail" id=""
                                        cols="30" rows="5">{{ $room->detail }}</textarea>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <p class="mb-0 mx-2">Available</p>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input" type="checkbox" name="status" {{ $room->status == 'available' ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <p class="mb-0 mx-2">Show In Site</p>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input" type="checkbox" name="show_in_site" {{ $room->show_in_site ? 'checked' : '' }}>
                                </div>
                            </div>
    

                            <input class="btn btn-info" type="submit" value="Update room" />
                            {{-- <a class="btn btn-danger" href="/room-types/{{ $room->id }}/delete" >
                                Delete
                            </a> --}}

                        </ul>
                    </form>
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
            // Select all elements with data-toggle="popover" in the document
            // $('[data-toggle="popover"]').popover();

        });
    </script>
@endsection
