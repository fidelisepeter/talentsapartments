@extends('layouts.main')
@section('page-title', 'Products')
@if (Auth::user()->role == 'student')
    {{-- Stay --}}
@else
    {{ Session::flash('error', 'You are not permited to view that page') }}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@section('content')
@php
$current_rent = DB::table('rents')->where('id', Auth::user()->current_rent)->first();
$bed_space = DB::table('bed_spaces')->where('id', $current_rent->bed_space)->first();
$room = $bed_space != null ? DB::table('rooms')->where('id', $bed_space->room_id)->first() : '';

@endphp
<form action="/renew_booking/{{ $current_rent->id }}" method="POST">
    @csrf
    @method('POST')
    <div class="row">

        <div class="col-lg-8 mb-lg-0 mb-4">
            <div class="card">


                <div class="card-body text-lg-start text-center">

                    <div class="row ">

                        <div class="col-12 mb-3">
                            <h6 class="text-lead text-center mb-2 mt-0">Update your Name</h6>
                            <div class="row mt-0">

                                <div class="col-sm-4 mt-sm-0">
                                    <label>First Name</label>
                                    <input name="first_name" class="multisteps-form__input form-control"
                                        type="text" onfocus="focused(this)" onfocusout="defocused(this)"
                                        value="{{ Auth::user()->first_name }}">
                                </div>
                                <div na class="col-sm-4 mt-sm-0">
                                    <label>Middle Name</label>
                                    <input name="middle_name" class="multisteps-form__input form-control"
                                        type="text" onfocus="focused(this)" onfocusout="defocused(this)"
                                        value="{{ Auth::user()->middle_name }}">
                                </div>
                                <div class="col-sm-4 mt-sm-0">
                                    <label>Last Name</label>
                                    <input name="last_name" class="multisteps-form__input form-control"
                                        type="text" onfocus="focused(this)" onfocusout="defocused(this)"
                                        value="{{ Auth::user()->last_name }}">
                                </div>
                            </div>
                            <hr color="grey" class="mb-0">
                        </div>

                        <div class="col-12 mb-3">
                            <h6 class="text-lead text-center mb-2 mt-0">Update school information</h6>
                            <div class="row mt-0">

                                <div class="col-sm-4 mt-sm-0">
                                    <label>School Name</label>
                                    <input placeholder="school" type="text"
                                    class="form-control"
                                    name="school" disabled value="{{ Auth::user()->school }}">
                                </div>
                                <div na class="col-sm-4 mt-sm-0">
                                    <label>Current Level</label>
                                    <select class="form-control @error('level') is-invalid @enderror"
                                        required name="level" id="">
                                        <option disabled selected>--Level--</option>
                                        <option value="pre_degree">Pre Degree</option>
                                        <option value="100">100</option>
                                        <option value="200" @if (Auth::user()->level == '100') selected @endif>200</option>
                                        <option value="300" @if (Auth::user()->level == '200') selected @endif>300</option>
                                        <option value="400" @if (Auth::user()->level == '300') selected @endif>400</option>
                                        <option value="500" @if (Auth::user()->level == '400') selected @endif>500</option>
                                        <option value="PostGraduate">Post Graduate</option>
                                    </select>
                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-sm-0">
                                    <label>Current Course</label>
                                    <input placeholder="course" type="text"
                                        class="form-control @error('course') is-invalid @enderror"
                                        name="course" required value="{{ Auth::user()->course }}">
                                    @error('course')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-4 mt-sm-0">
                                        <label>Faculty</label>
                                        <input placeholder="faculty" type="text"
                                        class="form-control @error('faulty') is-invalid @enderror"
                                        name="faculty" required value="{{ Auth::user()->faculty }}">
                                    @error('faculty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="col-sm-4 mt-sm-0">
                                        <label>Department</label>
                                        <input placeholder="department" type="text"
                                        class="form-control @error('department') is-invalid @enderror"
                                        name="department" required value="{{ Auth::user()->department }}">
                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="col-sm-4 mt-sm-0">
                                        <label>Jaja Card</label>
                                        <input  name="jaja_number"
                                        class="form-control @error('jaja_number') is-invalid @enderror"
                                        placeholder="enter value here" value="{{ Auth::user()->jaja_number }}">
                                    @error('jaja_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="row mt-3">
                                    <div class="col-sm-4 mt-sm-0">
                                        <label>Present Bedspace</label>
                                       
                                        <input name="first_name" class="multisteps-form__input form-control"
                                            type="text" onfocus="focused(this)" onfocusout="defocused(this)"
                                            value="{{ $bed_space != null ? $bed_space->room_number. ' - ' .$bed_space->name : '' }}" disabled>
                                    </div>
                                    <div class="col-auto mt-sm-0">
                                        <label>Do you want to Change Bed Types?</label>
                                        <select class="form-control"
                                        required id="change-bed-type">
                                        <option value="no">No</option>
                                        <option value="yes">Yes</option>
                                    </select>
                                    </div>
                                    </div>
                                    
                                </div>
                                <div class="col-12 mt-3 d-none" id="change-bed-type-container">
                                    <hr color="grey" class="mb-0 mt-3">
                                <h6 class="text-lead text-center mb-2 mt-3">Change Bed Types</h6>
                                <div class="row mt-0">
    
                                    <div class="col-12 mt-sm-0">
                                        <label>Location</label>
                                        <select onchange="loc_room()" class="form-control" name="location"
                                                    id="location" required>
                                                    <option disabled selected>--Location--</option>
                                                    @foreach (DB::table('locations')->get() as $locations)
                                                        <option @if ($room != null && $room->location == $locations->id) selected @endif
                                                            value="{{ $locations->id }}">
                                                            {{ $locations->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                    </div>
                                    <div na class="col-12 mt-sm-0">
                                        <label>Room Type</label>
                                        <select class="form-control room" name="room" id="room"
                                                    name="room" required>
                                                    @if ($room != null)
                                                    @php
                                                        $rooms = DB::table('rooms')->where('location', $room->location)->where('status', 'available')->where('show_in_site', true)->get();
                                                        foreach ($rooms as $room) {
                                                                $bedSpace = \App\Models\BedSpace::where('room_id', $room->id)->whereNull('user_id')->where('allocated', false)->get()->count();

                                                                if ($bedSpace > 0) {
                                                                    echo '<option value="' . $room->id . '">' . $room->name . '</option>';
                                                                }
                                                            }
                                                    @endphp             
                                                   
                                                    @endif

                                                </select>
                                    </div>
                                   
                                </div>
                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit"
                                    class="btn bg-gradient-dark mt-3 btn-block mb-0">
                                    Submit
                                    <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                                </div>
                            </div>
                               
                        </div>
                       

                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-lg-0 mb-4">
            <div class="card mb-5">
                <div class="card-header text-center pt-4 pb-3">
                    <h5>Room Info</h5>
                    <span class="badge rounded-pill bg-light text-dark"
                        id="show-room-name">Waiting...</span>
                    <h1 class="font-weight-bold mt-2">
                        <small class="h3">N</small> <span class="h1"
                            id="show-room-price">0.00</span> <span class="text-sm text-danger text-decoration-line-through"
                            id="show-original-price"></span>
                    </h1>
                </div>
                <div class="card-body text-lg-start text-center pt-0">
                   
                           
                            <div id="show-room-amenities">

                            </div>

                
                </div>
                

            </div>

           
        </div>

    </div>
</form>
@endsection
@section('script')
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="{{asset('/assets/js/services-payment-process.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#change-bed-type').click(function() {
                if ($(this).val() == 'yes') {
                    $('#change-bed-type-container').removeClass('d-none');
                } else if ($(this).val() == 'no') {
                    $('#change-bed-type-container').addClass('d-none');
                }
            });  

            var amountFormat = (amount) => {
                var getAmount = Number(amount);
                var format = {

                }
                return getAmount.toLocaleString("en-GB", format)
            }

            var loadDetails = (room_id) => {
                
                $.ajax({
                    url: "/get_room_by_id",
                    method: "GET",
                    data: {
                        id: room_id,

                    },
                    dataType: 'JSON',
                    beforeSend(xhr) {},
                    complete(xhr) {},
                    success: function(data) {

                        if (data.status == 'success') {
                            
                            $("#show-room-details").removeClass('d-none').addClass('d-block');
                            $("#show-room-price").html(amountFormat(data.room_details.price));
                            $("#show-original-price").html('');
                            $("#show-room-amenities").html(data.room_amenities);
                            $("#show-room-name").html(data.room_details.name);
                            $("#show-room-location").html(data.room_location);
                            $("#show-room-image").attr('style', "background-image: url('" + data
                                .room_details.photo + "'); background-size:cover;");
                            $("#apply-button").attr('disabled', false);

                        } else {
                            $("#show-room-details").removeClass('d-block').addClass(
                                'd-none');
                            $("#show-room-price").html('0.00');
                            $("#show-original-price").html('');
                            $("#show-room-amenities").html('');
                            $("#show-room-name").html('Type');
                            $("#apply-button").attr('disabled', true);
                        }
                    },
                    error: function(xhr) {
                        alert('error')
                    }
                });
            }

            $("#location").on('change', function() {
                var location = $(this).val();


                $.ajax({
                    url: "/get_rooms_by_locations",
                    method: "GET",
                    data: {
                        location: location,

                    },
                    dataType: 'JSON',
                    beforeSend(xhr) {},
                    complete(xhr) {},
                    success: function(data) {

                        if (data.status == 'success') {
                            // alert(JSON.stringify(data))

                            $("#room").html(data.room_list);




                        } else if (data.status == 'error') {
                            // alert(JSON.stringify(data))

                            $("#room").html(data.room_list);

                            Swal.fire(
                                'Unavailable!',
                                data.message,
                                'error'
                            );


                        }
                    },
                    error: function(xhr) {
                        alert('error')
                    }
                });

            });

            $("#room").on('change', function() {
                var room_id = $(this).val();
                loadDetails(room_id);
            });

        loadDetails('{{ $bed_space->room_id ?? '' }}');

        });
    </script>
@endsection
