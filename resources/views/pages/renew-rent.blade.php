@extends('layouts.main')
@section('page-title', 'Rent Renewal')
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
        $current_rent = DB::table('rents')
            ->where('id', Auth::user()->current_rent)
            ->first();
        $bed_space = DB::table('bed_spaces')
            ->where('id', $current_rent->bed_space)
            ->first();
        $room =
            $bed_space != null
                ? DB::table('rooms')
                    ->where('id', $bed_space->room_id)
                    ->first()
                : '';
        $new_rent = DB::table('rents')
            ->where('type', 'renewal')
            ->where('previous_rent', $main_rent->id)
            ->first();
        $requested_room = $new_rent
            ? DB::table('rooms')
                ->where('id', $new_rent->requested_room)
                ->first()
            : '';
        
        $new_rent_payment = $new_rent
            ? DB::table('invoices')
                ->where('application_no', $new_rent->payment_reference)
                ->first()
            : '';
        
    @endphp
    @if ($new_rent)
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="card mb-3">
                    <div class="card-body">
                        @if ($new_rent->status == 'Approved')
                            @if ($new_rent->change_room && $new_rent->room_change_status == 'Approved')
                                <h5 class="text-center text-success">
                                    <strong>APPROVED</strong> : Your Request to change to
                                    {{ $requested_room->name ?? '' }} has been
                                    Approved.
                                </h5>
                            @elseif ($new_rent->change_room && $new_rent->room_change_status == 'Declined')
                                <h5 class="text-center text-danger">
                                    <strong>DENIED</strong> : Your Request to change to
                                    {{ $requested_room->name ?? '' }} has been Denied due to unavailability.
                                </h5>
                            @else
                                <h5 class="text-center text-success">
                                    <strong>APPROVED</strong> : Your Request has been
                                    Approved.
                                </h5>
                            @endif
                            @if (
                                (isset($new_rent_payment->payment_status) && $new_rent_payment->payment_status == 'paid') ||
                                    (isset($new_rent_payment->status) && $new_rent_payment->status == 'paid'))
                                {{-- Cant Edit has payment info --}}
                                <div class="text-center">
                                    <a class="btn btn-sm bg-gradient-info my-sm-auto mt-2 mb-0"
                                        href="/booking/{{ $new_rent->id }}">View
                                        Details</a>
                                </div>
                            @else
                                <p class="text-center">
                                    You have until
                                    {{ \Carbon\Carbon::parse($new_rent->updated_at)->addDays(7)->format('Y-m-d') }} to make
                                    payment of {{ number_format($new_rent->price) }}. <br>
                                    Inability to make payment by the date above invalidates the offer
                                </p>
                                <div class="@if ($new_rent->payment_reference == null) d-none @endif" id="payment_box"
                                    data-application_no="{{ $new_rent->payment_reference ?? '' }}"
                                    data-transaction_id="{{ strtoupper(substr(str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890'), 0, 12)) }}"
                                    data-phone_number="{{ DB::table('users')->where('id', $new_rent->user_id)->value('phone_number') }}"
                                    data-full_name="{{ DB::table('users')->where('id', $new_rent->user_id)->value('first_name') .' ' .DB::table('users')->where('id', $new_rent->user_id)->value('middle_name') .' ' .DB::table('users')->where('id', $new_rent->user_id)->value('last_name') }}"
                                    data-amount="{{ $new_rent->price }}"
                                    data-original-amount="{{ $new_rent->original_price }}">
                                    <h5 class="text-center">Choose a method of payment</h5>
                                    <div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" {{-- id="pay_via_online" --}} onclick="payWithPaystackDeactivated()">
                                            <div class="d-flex border border-warning rounded">
                                                <div class="avatar avatar-lg">
                                                    <img alt="Image placeholder"
                                                        src="{{ asset('/assets/img/logos/mastercard.png') }}">
                                                </div>
                                                <div class="ms-2 my-auto">


                                                    <span class="mb-0" style="color:black">Pay Online</span>
                                                    <p class="text-xs mb-0">Mastercard, Verve, Visa, etc</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="pay_via_bankWWWW" data-toggle="modal"
                                            data-target="#direct_payment_confirm">
                                            <div class="d-flex border border-dark bg-white rounded">
                                                <div class="avatar avatar-lg">
                                                    <img alt="Image placeholder"
                                                        src="{{ asset('/assets/img/small-logos/icon-bulb.svg') }}"
                                                        height="45">
                                                </div>
                                                <div class="ms-2 my-auto">
                                                    <span class="mb-0" style="color:black">Bank
                                                        Transfer</span>
                                                    <p class="text-xs mb-0">Transfer from your account or bank
                                                        branch</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex bg-gray-100 border-radius-lg p-3 my-3">

                                        <div>
                                            <h6 class="my-auto">

                                                <span class="text-secondary text-sm me-1">Invoice
                                                    No:</span>{{ $new_rent->payment_reference }}

                                            </h6>
                                            <h4 class="my-auto">
                                                <span
                                                    class="text-secondary text-sm me-1">₦</span>{{ number_format($new_rent->price) }}

                                            </h4>
                                            <span class="text-secondary text-sm ms-1">Pay using your Debit Card
                                                (master card, visa, verse, etc..) or Payment via bank
                                                transfer</span>

                                        </div>


                                    </div>
                                </div>
                                <div class="@if ($new_rent->payment_reference != null) d-none @endif text-center mb-3"
                                    id="invoice_box">
                                    <h6 class="text-center">You have not created any invoice for this booking
                                    </h6>
                                    <p class="text-center">Click the button below to generate an invoice</p>
                                    <button id="create_invoice" class="btn btn-sm bg-gradient-primary mb-0 mt-2"
                                        type="button">
                                        Make Payment
                                    </button>
                                </div>
                            @endif
                        @elseif ($new_rent->status == 'Declined')
                            <h5 class="text-center text-danger">
                                We are sorry to inform you that your rent renewal was declined by our administrator. if you
                                think this is a mistake please send us an email to <a
                                    href="mailto:                                {{ DB::table('settings')->value('complain_email_recipient') }}">
                                    {{ DB::table('settings')->value('complain_email_recipient') }}</a>
                            </h5>
                        @else
                            <h5 class="text-center">
                                We have recieved your request to renew your rent and its awaiting for aproval by our
                                adminitrator. we
                                will
                                get back to you shortly.
                            </h5>
                            <p class="text-center">Details will also be sent to your email! dont forget to always check your
                                junck mail
                            </p>
                        @endif

                    </div>
                </div>

                @if (
                    (isset($new_rent_payment->payment_status) && $new_rent_payment->payment_status == 'paid') ||
                        (isset($new_rent_payment->status) && $new_rent_payment->status == 'paid'))
                    {{-- Cant Delete has payment info --}}
                @else
                    <div class="card">
                        <div class="card-body">
                            <form action="/cancel-renewal/{{ $new_rent->id }}" method="GET">



                                <div class="text-center">
                                    <p class="">
                                        Thank you I am no longer interested in staying at Talents Apartment. <br>
                                        I voluntarily give up my bedspace and i will move out by
                                        {{ \Carbon\Carbon::parse($main_rent->expiring_date)->format('Y-m-d') }}

                                    </p>
                                    <button type="submit" id="update-documents-status"
                                        class="btn bg-gradient-danger mt-3  mb-0 bt" onclick="this.form.submit()">
                                        Cancel Renewal?
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @else
        <form action="/renew_booking/{{ $current_rent->id }}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" name="current_rent" value="{{ $current_rent->id }}">
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
                                            <input placeholder="school" type="text" class="form-control"
                                                name="school" disabled value="{{ Auth::user()->school }}">
                                        </div>
                                        <div na class="col-sm-4 mt-sm-0">
                                            <label>Current Level</label>
                                            <select class="form-control @error('level') is-invalid @enderror" required
                                                name="level" id="">
                                                <option disabled selected>--Level--</option>
                                                <option value="pre_degree">Pre Degree</option>
                                                <option value="100">100</option>
                                                <option value="200" @if (Auth::user()->level == '100') selected @endif>
                                                    200
                                                </option>
                                                <option value="300" @if (Auth::user()->level == '200') selected @endif>
                                                    300
                                                </option>
                                                <option value="400" @if (Auth::user()->level == '300') selected @endif>
                                                    400
                                                </option>
                                                <option value="500" @if (Auth::user()->level == '400') selected @endif>
                                                    500
                                                </option>
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
                                                class="form-control @error('course') is-invalid @enderror" name="course"
                                                required value="{{ Auth::user()->course }}">
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
                                                class="form-control @error('faulty') is-invalid @enderror" name="faculty"
                                                required value="{{ Auth::user()->faculty }}">
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
                                            <input name="jaja_number"
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

                                                <input name="present_bedspace" class="multisteps-form__input form-control"
                                                    type="text" onfocus="focused(this)" onfocusout="defocused(this)"
                                                    value="{{ $bed_space != null ? $bed_space->room_number . ' - ' . $bed_space->name : '' }}"
                                                    disabled>
                                            </div>
                                            <div class="col-auto mt-sm-0">
                                                <label>Do you want to Change Bed Types?</label>
                                                <select class="form-control" required id="change-bed-type">
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
                                            <div class="col-12 col-md-6 mt-sm-0">
                                                <label>Room Type</label>
                                                <select class="form-control room" id="room" name="room" required>
                                                    @if ($room != null)
                                                        @php
                                                            $rooms = DB::table('rooms')
                                                                ->where('location', $room->location)
                                                                ->where('status', 'available')
                                                                ->where('show_in_site', true)
                                                                ->get();
                                                            foreach ($rooms as $room) {
                                                                $bedSpace = \App\Models\BedSpace::where('room_id', $room->id)
                                                                    ->whereNull('user_id')
                                                                    ->where('allocated', false)
                                                                    ->get()
                                                                    ->count();
                                                            
                                                                if ($bedSpace > 0) {
                                                                    echo '<option value="' . $room->id . '">' . $room->name . '</option>';
                                                                }
                                                            }
                                                        @endphp
                                                    @endif

                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6 mt-sm-0">
                                                <label>Bed Space</label>
                                                <select class="form-control room" id="show-bedspaces" name="bedspace">
                                                    <option value="{{ $bed_space != null ? $bed_space->id : '' }}">
                                                        {{ $bed_space != null ? $bed_space->room_number . ' - ' . $bed_space->name : '' }}
                                                    </option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="submit" class="btn bg-gradient-dark mt-3 btn-block mb-0">
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
                            <span class="badge rounded-pill bg-light text-dark" id="show-room-name">Waiting...</span>
                            <h1 class="font-weight-bold mt-2">
                                <small class="h3">N</small> <span class="h1" id="show-room-price">0.00</span>
                                <span class="text-sm text-danger text-decoration-line-through"
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
    @endif
    <div class="modal fade" id="direct_payment_confirm" tabindex="-1" role="dialog"
        aria-labelledby="direct_payment_confirm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Your Payment</h5>
                    <button type="button" class="btn-close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <p class=" text-sm mb-0 font-weight-bolder">To confirm your payment please fill the form and submit</p>

                    <form role="form" id="buyForm" action="/send_payment_info" method="POST">
                        @csrf
                        {{-- <input class="form-control" type="hidden" value="bank_transfer" name="type"> --}}
                        <input class="form-control" type="hidden" value="{{ $new_rent->payment_reference ?? '' }}"
                            name="application_no">
                        {{-- <input class="form-control" type="hidden" value="{{ $rent->original_price ?? '' }}" name="original_amount"> --}}

                        <div class="">
                            <label>Bank Transaction ID</label>

                            <input class="form-control" type="text" name="bank_transaction_id">

                            <label>Sender Name</label>
                            <input class="form-control" type="text" name="sender_name">

                            <label>Bank Name</label>
                            <input class="form-control" type="text" name="bank_name">

                        </div>
                        <div class="button-row d-flex mt-4">
                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                title="Next">Send Details</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="{{ asset('/assets/js/booking-payment-process.js') }}"></script>
    <script>
        var payWithPaystackDeactivated = () => {
            const requiredButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-gradient-success',
                    cancelButton: 'btn bg-gradient-danger',
                    closeButton: 'btn bg-gradient-primary'
                },
                buttonsStyling: false,
            })
            requiredButtons.fire({
                title: 'Something went wrong!',
                text: 'Sorry this option is not available right now',
                icon: 'error',
                showCloseButton: true,
            })
        }
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
                            $("#show-bedspaces").html(data.bed_space_list);
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
                            $("#show-bedpaces").html('');
                            $("#show-room-name").html('Type');
                            $("#apply-button").attr('disabled', true);
                        }
                    },
                    error: function(xhr) {

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



            $("#create_invoice").on('click', function() {

                var rent_id = "{{ $new_rent->id ?? '' }}";
                var user_id = "{{ $new_rent->user_id ?? '' }}";
                var _token = "{{ csrf_token() }}";

                $.ajax({
                    url: "/create_invoice",
                    method: "POST",
                    dataType: 'JSON',
                    data: {
                        rent_id: rent_id,
                        type: 'Rent Booking',
                        user_id: user_id,
                        _token: _token,
                    },
                    beforeSend(xhr) {},
                    complete(xhr) {},
                    success: function(data) {

                        if (data.status === 'success') {
                            Swal.fire(
                                'Success!',
                                data.message,
                                'success'
                            );
                            $('#payment_box').removeClass('d-none');
                            $('#invoice_box').addClass('d-none');
                            $('#payment_box').attr('data-application_no', data.application_no);
                            window.location.reload();

                        } else {
                            Swal.fire(
                                'Error!',
                                data.message,
                                'error'
                            );
                        }

                    },

                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'An Internal Error Occured',
                            'error'
                        );
                    }
                });

            });

        });
    </script>
@endsection
