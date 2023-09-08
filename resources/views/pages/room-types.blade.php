@extends('layouts.main')
@section('page-title', 'Rooms')
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
                        Talents Room Category

                    </h5>

                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-1">Rooms</h6>
                    <p class="text-sm">student confort at it best</p>
                    
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 mb-5">
                            <div class="card h-100 card-plain border p-3 shadow-blur">
                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    <a href="javascript:;" data-toggle="modal" data-target="#new-room">
                                        <i class="fa fa-plus text-secondary mb-3"></i>
                                        <h5 class=" text-secondary"> New Room </h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @foreach ($rooms as $room)
                        {{-- @dd($room->no_of_rooms) --}}
                            @php
                                $rent_count = DB::table('rents')
                                    ->where('room_id', $room->id)
                                    ->count(); // 5
                                $capacity = $room->capacity * $room->no_of_rooms;
                                $avalaible = $capacity - $rent_count;
                            @endphp
                            <div class="col-xl-3 col-sm-6 mb-5">
                                <div class="card h-100 card-plain border p-3 shadow-blur">
                                    <div class="position-relative">
                                        <a class="d-block shadow-xl border-radius-xl">
                                            <img src="{{ $room->photo ?? '/assets/img/no-image.png' }}"
                                                alt="{{ $room->name }}" class="img-fluid shadow border-radius-lg"
                                                style="height:120px; width:100%;">
                                        </a>
                                    </div>
                                    <div class="card-body px-1 pb-0">
                                        <p class="text-dark mb-2 text-sm">
                                            <a href="javascript:;">₦
                                                {{ $room->price }}</a>
                                            <a href="/room/delete/{{ $room->id }}" style="float:right;"
                                                type="button" class="float-right text-danger text-bold mb-0"><i
                                                    class="fa fa-trash me-sm-1"></i> Delete</a>
                                        </p>
                                        <a href="/room-types/{{ $room->id }}" class="">
                                            <h5 data-toggle="popover" title="Discription: {{ $room->detail }}"
                                                data-content="{{ $room->detail }}">
                                                {{ $room->name }}
                                            </h5>
                                            <span class="mb-0 text-sm text-dark font-weight-bold">Rooms:
                                            </span>
                                            <span class="text-xxl opacity-7">{{ $room->total_rooms}} </span>
                                            <br> 
                                            <span class="mb-0 text-sm text-dark font-weight-bold">Bed Spaces:
                                            </span>
                                            <span class="text-xxl opacity-7">{{ $room->bedspace}} ({{ $room->available}} available)</span> 

                                        </a>


                                        {{-- <p class="mb-4 text-sm">
                                    {{$room->detail}}
                                </p> --}}

                                        <div class="d-flex align-items-center justify-content-between mt-0">
                                            @if ($room->status == 'available')
                                                <a href="/room/status/{{ $room->id }}" type="button"
                                                    class="btn btn-primary btn-sm mb-0 w-100">Make Unavailable</a>
                                            @else
                                                <a href="/room/status/{{ $room->id }}" type="button"
                                                    class="btn btn-outline-primary btn-sm mb-0 w-100">Make available</a>
                                            @endif

                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>
            <div class="align-items-center mb-5" style="align-items: center !important;">
               {!! $rooms->links('') !!}
            </div>
        </div>

    </div>
    <div class="modal fade" id="new-room" tabindex="-1" role="dialog" aria-labelledby="new-room"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card shadow border-0 mb-0 p-3">

                                        <div class="card-body p-3">
                                            <form method="POST" action="create_room" enctype="multipart/form-data">@csrf
                                                <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                                    Room Name</h6>
                                                <ul class="list-group">
                                                    <div class="mt-0 border-0 px-0">
                                                        <div class="form-check form-switch ps-0">
                                                            <input required placeholder="eg Deluxe"
                                                                class="form-input ms-auto form-control" type="text"
                                                                name="name" id="">
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
                        <option value="{{ $location->id }}">
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
                <input required class="form-input ms-auto form-control"
                    placeholder="500" type="text" name="price"
                    id="">
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
                                                                            <input id="amenities" type="checkbox"
                                                                                name="amenities[]" class="form-check-input "
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
                                                        
                                                        {{-- <div class="col-xl-4 col-md-6 mb-4">

                                                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                                                Number of Rooms</h6>

                                                            <div class="mt-0 border-0 px-0">
                                                                <div class="form-check form-switch ps-0">
                                                                    <input type="text" name="number_of_rooms"
                                                                        class="form-control" placeholder="eg 20"
                                                                        id="">
                                                                </div>
                                                            </div>


                                                        </div> --}}
                                                        {{-- <div class="col-xl-4 col-md-6 mb-4">
                                                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                                                Room Capacity</h6>

                                                            <div class="mt-0 border-0 px-0">
                                                                <div class="form-check form-switch ps-0">

                                                                    <select class="form-control" name="capacity">
                                                                        <option value="1">1</option>
                                                                        <option value="3">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    </div>



                                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                                        Room Photo</h6>

                                                    <div class="mt-0 border-0 px-0">
                                                        <div class="form-check form-switch ps-0">
                                                            <input required class="form-input ms-auto form-control"
                                                                placeholder="500" type="file" name="photo"
                                                                id="">
                                                        </div>
                                                    </div>


                                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">
                                                        Room Detail</h6>

                                                    <div class="mt-0 border-0 px-0">
                                                        <div class="form-check form-switch ps-0">
                                                            <textarea required class="form-control" placeholder="say something about the room" name="detail" id=""
                                                                cols="30" rows="5"></textarea>
                                                        </div>
                                                    </div>

                                                    <input class="btn btn-info" type="submit"
                                                        value="+ Create a new room" />

                                                </ul>
                                            </form>
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
                // Select all elements with data-toggle="popover" in the document
                // $('[data-toggle="popover"]').popover();

            });
        </script>
    @endsection
