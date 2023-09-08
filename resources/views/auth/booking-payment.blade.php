<!--
=========================================================
* Soft UI Dashboard PRO - v1.0.9
=========================================================

* Product Page:  https://www.creative-tim.com/product/soft-ui-dashboard-pro
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Talent Apartments
    </title>
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/fontawesome-free/css/all.min.css') }}" crossorigin="anonymous"></script>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css') }}?v=1.0.9" rel="stylesheet" />
    <script src="{{ asset('assets/js/plugins/sweetalert.min.js') }}"></script>
</head>

<div class="d-none">
    @if ($message = session('success'))
        {{ $message }}
        <script>
            //  Swal.fire('Success!', '{{ $message }}', 'success' );
            Swal.fire("Success", "{{ $message }}", "success");
        </script>
    @endif


    @if ($message = session('error'))
        {{ $message }}
        <script>
            Swal.fire("Error", "{{ $message }}", "error");
        </script>
    @endif


    @if ($message = session('warning'))
        {{ $message }}
        <script>
            Swal.fire("Warning", "{{ $message }}", "warning");
        </script>
    @endif


    @if ($message = session('info'))
        {{ $message }}
        <script>
            Swal.fire("Info", "{{ $message }}", "info");
        </script>
    @endif
</div>

<body class="g-sidenav-show  bg-gray-100">
    
    <div class="page-header bg-gradient-primary  position-relative m-3 border-radius-xl">
        <img src="{{ asset('asset/img/shapes/waves-white.svg') }}" alt="pattern-lines"
            class="position-absolute opacity-6 start-0 top-0 w-100">
        <div class="container pb-lg-9 pb-10 pt-7 postion-relative z-index-2">
            <div class="row">
                <div class="col-md-6 mx-auto text-center">
                    <h3 class="text-white mt-3">Hello {{ Auth::user()->first_name }} complete your payment</h3>
                    <p class="text-white text-lead text-center">You are on track to getting the best comfort, all
                        through your
                        academic year</p>

                    @if ($errors->any())
                        <script>
                            swal("Error", "All Field Are Required", "error");
                        </script>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <div class="mt-n8">
        <div class="container">

          
                <div class="row">

                    <div class="col-lg-8 mb-lg-0 mb-4 m-auto">
                        <div class="card">


                            <div class="card-body text-lg-start text-center" id="payment_box"
                                                data-application_no="{{ $rent->payment_reference ?? '' }}"
                                                data-transaction_id="{{ strtoupper(substr(str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890'), 0, 12)) }}"
                                                data-phone_number="{{ DB::table('users')->where('id', $rent->user_id)->value('phone_number') }}"
                                                data-full_name="{{ DB::table('users')->where('id', $rent->user_id)->value('first_name') .' ' .DB::table('users')->where('id', $rent->user_id)->value('middle_name') .' ' .DB::table('users')->where('id', $rent->user_id)->value('last_name') }}"
                                                data-amount="{{ $rent->price }}"
                                                data-original-amount="{{ $rent->original_price }}">

                                                <div class="row ">
                                                    <div class="col-12">
                                                        @if (session('success'))
                                                            <div class="alert  alert-success">
                                                                {{ session('success') }}
                                                            </div>
                                                        @endif
                                                        @if (session('error'))
                                                            <div class="alert alert-danger">
                                                                {{ session('error') }}
                                                            </div>
                                                        @endif
                                                        @if ($errors)
                                                            @foreach ($errors->all() as $error)
                                                                <div class="alert alert-danger">{{ $error }}</div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                        
                                 <h3 class="text-center">Payment for {{ App\Models\Room::where('id', $rent->room_id)->first()->name }} (₦{{ number_format($invoice->amount) }})</h3>
                                <h5 class="text-center">Choose a method of payment</h5>
                                <div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" 
                                    {{-- id="pay_via_online" --}}
                                    onclick="payWithPaystackDeactivated()"
                                    >
                                        <div class="d-flex border border-warning rounded">
                                            <div class="avatar avatar-lg">
                                                <img alt="Image placeholder" src="{{ asset('assets/img/logos/mastercard.png') }}">
                                            </div>
                                            <div class="ms-2 my-auto">
            
            
                                                <span class="mb-0" style="color:black">Pay Online</span>
                                                <p class="text-xs mb-0">Mastercard, Verve, Visa, etc</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"  data-toggle="modal" data-target="#direct_payment_confirm">
                                        <div class="d-flex border border-dark bg-white rounded">
                                            <div class="avatar avatar-lg">
                                                <img alt="Image placeholder" src="{{ asset('assets/img/small-logos/icon-bulb.svg') }}"
                                                    height="45">
                                            </div>
                                            <div class="ms-2 my-auto">
                                                <span class="mb-0" style="color:black">Bank Transfer</span>
                                                <p class="text-xs mb-0">Transfer from your account or bank
                                                    branch</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="d-flex bg-gray-100 border-radius-lg p-3 my-3">
            
                                    <div>
                                        <h6 class="my-auto">
            
                                            <span class="text-secondary text-sm me-1">Invoice No:</span>{{ $invoice->application_no }}
            
                                        </h6>
                                      
                                        <span class="text-secondary text-sm ms-1">Pay using your Debit Card
                                            (master card, visa, verse, etc..) or Payment via bank
                                            transfer</span>
            
                                    </div>
            
            
                                </div>


                            
                            </div>

                        </div>
                        
                        {{-- <button type="submit" id="apply-button"
                            class="btn bg-gradient-dark d-lg-block mt-3 btn-block mb-0 btn-lg w-100" disabled>
                            Save Information
                            <i class="fas fa-arrow-right ms-1"></i>
                        </button> --}}
                    </div>

                </div>
            
        </div>
<!-- Direct Payment Model -->
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
                <input class="form-control" type="hidden" value="{{ $rent->payment_reference ?? '' }}"
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

    </div>
    </div>
    </div>

    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">

            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        {{ config('app.name', 'Laravel') }}
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with ❤️ by
                        <a href="http://alresia.com" class="font-weight-bold" target="_blank">Alresia Inc</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    <!-- Kanban scripts -->
    <script src="../assets/js/plugins/dragula/dragula.min.js"></script>
    <script src="../assets/js/plugins/jkanban/jkanban.js"></script>

    {{-- <script src="{{ asset('assets/js/plugins/sweetalert.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/booking-payment-process.js') }}"></script>
    
   
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script>
        function payWithPaystackDeactivated() {
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
            // alert(JSON.stringify('data'));
            var amountFormat = (amount) => {
                var getAmount = Number(amount);
                var format = {

                }
                return getAmount.toLocaleString("en-GB", format)
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
                            // alert(JSON.stringify(data.room_amenities))

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

                            
                            // $("#show-room-location").html(data.room_location);
                            // $("#show-room-image").attr('style', "background-image: url('" + data
                            //     .room_details.photo + "'); background-size:cover;");
                            $("#apply-button").attr('disabled', true);
                        }
                    },
                    error: function(xhr) {
                        alert('error')
                    }
                });

            });
        });
    </script>

    <script>
        $(document).ready(function() {

            var amountFormat = (amount) => {
                var getAmount = Number(amount);
                var format = {

                }
                return getAmount.toLocaleString("en-GB", format)
            }

            $('#check-promo-button').click(function() {
                var promo_code = $('#promo-code').val();
                var room_id = $('#room').val();
                // alert(promo_code)

                if (room_id === null) {
                    $("#promo-description").text('Please select a location and a room');
                    $("#promo-description").addClass('text-danger');
                    // $("#promo-description").text('Please select a location and a room');
                    return
                }

                $.ajax({
                    url: "/check-promo-code",
                    method: "GET",
                    data: {
                        room_id: room_id,
                        promo_code: promo_code
                    },
                    dataType: 'JSON',
                    beforeSend(xhr) {},
                    complete(xhr) {},
                    success: function(data) {

                        // alert(JSON.stringify(data))

                        if (data.status == 'success') {
                            $("#show-room-details").removeClass('d-none').addClass('d-block');
                            $("#show-original-price").html(amountFormat(data.room.price));
                            $("#show-room-price").html(amountFormat(data.discount_price));
                            $("#show-room-amenities").html(data.room_amenities);
                            $("#show-room-name").html(data.room.name);
                            $("#show-room-location").html(data.room_location);
                            $("#show-room-image").attr('style', "background-image: url('" + data
                                .room.photo + "'); background-size:cover;");
                            $("#apply-button").attr('disabled', false);
                            $("#promo-description").text(data.message);
                            $("#promo-description").removeClass('text-danger');
                            $("#promo-applied").removeClass('d-none').addClass('d-block');
                        }else{
                            $("#show-room-details").removeClass('d-none').addClass('d-block');
                            $("#show-room-price").html(amountFormat(data.room.price));
                            $("#show-original-price").html('');
                            $("#show-room-amenities").html(data.room_amenities);
                            $("#show-room-name").html(data.room.name);
                            $("#show-room-location").html(data.room_location);
                            $("#show-room-image").attr('style', "background-image: url('" + data
                                .room.photo + "'); background-size:cover;");
                            $("#promo-description").text(data.message);
                            $("#promo-description").addClass('text-danger');
                            $("#promo-applied").removeClass('d-block').addClass('d-none');
                        }

                    },
                    error: function(xhr) {
                        // alert(JSON.stringify(xhr))
                    }
                });
            });

            $('#promo-code-action').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#promo-code-box').removeClass('d-none');
                    // alert("Checkbox is checked.");
                } else if ($(this).prop("checked") == false) {
                    $('#promo-code-box').addClass('d-none');
                }
            });


        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.9"></script>
</body>

</html>
