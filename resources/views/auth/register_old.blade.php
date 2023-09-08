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
        Talents Apartment
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.9" rel="stylesheet" />
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->

                <nav
                    class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid">
                        <a class="navbar-brand font-weight-bolder ms-sm-3" href="/" rel="tooltip" title=""
                            data-placement="bottom" target="_blank">
                            <img src="/logo-transparent.png" class="navbar-brand-img h-100 rounded " alt="main_logo"
                                style="width: 100px;">
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0" id="navigation">
                            <ul class="navbar-nav navbar-nav-hover ms-lg-5 ps-lg-5 w-100">
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a Href="/"
                                        class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                                        Home
                                    </a>

                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a Href="/#rooms"
                                        class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                                        Rooms
                                    </a>

                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a Href="/#features"
                                        class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                                        Features
                                    </a>

                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a Href="/#contact"
                                        class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                                        Contact
                                    </a>

                                </li>



                                <li class="nav-item ms-lg-auto my-auto ms-3 ms-lg-0">
                                    <a href="/login"
                                        class="btn btn-sm bg-gradient-info  btn-round mb-0 me-1 mt-2 mt-md-0">Login</a>

                                    <a href="https://api.whatsapp.com/send/?phone=2348069578636&text&type=phone_number&app_absent=0"
                                        class="btn btn-sm bg-gradient-success  btn-round mb-0 me-1 mt-2 mt-md-0">WhatsApp</a>


                                    <a data-bs-toggle="modal" data-bs-target="#call-me-back"
                                        class="btn btn-sm  bg-gradient-dark  btn-round mb-0 me-1 mt-2 mt-md-0">Call Me
                                        Back</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain mt-7">
                                <div class="card-header pb-0 text-left mb-0">
                                    <h6 class="font-weight-bolder">Application Form</h6>
                                    <p class="mb-0 text-sm">Enter your email and password to register</p>
                                </div>
                                <div class="card-body pb-0">
                                    <form method="POST" action="/application_setup">
                                        @csrf

                                        <label>Full Name</label>
                                        <div class="mb-1">
                                            <input id="full_name" placeholder="Names" type="text"
                                                class="form-control @error('full_name') is-invalid @enderror"
                                                name="full_name" value="{{ old('full_name') }}" required
                                                autocomplete="full_name" autofocus>

                                            @error('full_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>





                                        <label>Email</label>
                                        <div class="mb-1">
                                            <input id="email" placeholder="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label>Phone Number</label>
                                        <div class="mb-1">
                                            <input id="phone_number" placeholder="Phone Number" type="number"
                                                maxlength="11"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                name="phone_number" value="{{ old('phone_number') }}" required
                                                autocomplete="phone_number" autofocus>

                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        @if (DB::table('settings')->value('referral') && DB::table('settings')->value('referral_expiring_date') > \Carbon\Carbon::now())
                                            <div class="form-check form-check-info text-left">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="referral-code-action"
                                                    @if (request('ref') != null) checked @endif>
                                                <label class="form-check-label" for="referral-code-action">
                                                    I have a referral code</a>
                                                </label>
                                            </div>
                                            <div id="referral-code-box"
                                                class=" @if (request('ref') == null) d-none @endif">
                                                <label>Referral Code</label>
                                                <div class="mb-1">
                                                    <input type="text"
                                                        class="form-control @error('referral_code') is-invalid @enderror"
                                                        name="referral_code" value="{{ request('ref') }}"
                                                        autocomplete="referral_code"
                                                        @if (request('ref') != null) readonly @endif
                                                        >


                                                </div>
                                            </div>
                                        @endif


                                        <div class="form-check form-check-info text-left">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault" checked>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                I agree the <a href="#"
                                                    class="text-dark font-weight-bolder">Terms and Conditions</a>
                                            </label>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn bg-gradient-primary w-100 mt-4 mb-0"
                                                type="submit">Proceed</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-sm-4 px-1">
                                    <p class="mb-4 mx-auto">
                                        Already have an account?
                                        <a href="./login" class="text-primary text-gradient font-weight-bold">Sign
                                            in</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div
                                class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
                                <img src="../assets/img/shapes/pattern-lines.svg" alt="pattern-lines"
                                    class="position-absolute opacity-4 start-0">
                                <div class="position-relative border-radius-10">
                                    <img class="max-width-500 w-100 position-relative z-index-2"
                                        src="../assets/img/914625530-612x612.jpg"
                                        alt="lady carying a basket with parent behind" style="border-radius: 15px;">
                                </div>
                                <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                                <p class="text-lead text-white">You are on track to getting the best comfort, all
                                    through your academic year</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="call-me-back">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Call Me Back</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-horizontal" method="POST" action="/call-me-back" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-body contact-form">


                        <p>Complete the form and we will call you back!</p>
                        {{-- <div class="row text-center py-3 mt-3">
    <div class="col-4 mx-auto">
     <input type="text" class="form-control" name="name" placeholder="Enter Your Name" data-error="Name is required." required="required">
                        <div class="help-block with-errors"></div>
    </div>
  </div> --}}


                        <div class="single-form form-group mt-3">
                            <input type="text" class="form-control" name="name" placeholder="Enter Your Name"
                                data-error="Name is required." required="required">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="single-form form-group mt-3">
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                data-error="Name is required." required="required">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="single-form form-group mt-3">
                            <input type="tel" class="form-control" name="phone" placeholder="Phone"
                                data-error="Name is required." required="required">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="single-form form-group">
                            <button class="btn btn-sm  bg-gradient-info  btn-round mb-0 me-1 mt-2 mt-md-0"
                                type="submit">Call Me Back</button>
                            <button type="button"
                                class="btn btn-sm bg-gradient-dark btn-round mb-0 me-1 mt-2 mt-md-0"
                                data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                    {{-- <div class="modal-footer justify-content-between">
  
                    <div class="single-form form-group">
                        <button class="main-btn" type="submit">Call Me Back</button>
                    </div>
                </div> --}}
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">

            </div>
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
    <!--   Core JS Files   -->

    <!--   Core JS Files   -->

    {{-- <script src="./dashboard-assets/js/core/modernizr-3.6.0.min.js"></script>
    <script src="./dashboard-assets/js/core/jquery-1.12.4.min.js"></script> --}}

    {{-- <script src="./dashboard-assets/js/core/jquery-3.3.1.min.js" type="text/javascript"></script> --}}
    <script src="./dashboard-assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="./dashboard-assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="./dashboard-assets/js/plugins/perfect-scrollbar.min.js"></script>




    <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
    <script src="./dashboard-assets/js/plugins/countup.min.js"></script>





    <script src="./dashboard-assets/js/plugins/choices.min.js"></script>





    <script src="./dashboard-assets/js/plugins/prism.min.js"></script>
    <script src="./dashboard-assets/js/plugins/highlight.min.js"></script>





    <!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
    <script src="./dashboard-assets/js/plugins/rellax.min.js"></script>
    <!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
    <script src="./dashboard-assets/js/plugins/tilt.min.js"></script>
    <!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
    <script src="./dashboard-assets/js/plugins/choices.min.js"></script>


    <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
    <script src="./dashboard-assets/js/plugins/parallax.min.js"></script>








    <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
    <!--  Google Maps Plugin    -->


    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script> --}}
    <script src="./dashboard-assets/js/soft-design-system.min.js?v=1.0.9" type="text/javascript"></script>

    {{-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="./dashboard-assets/js/gmaps.js"></script> --}}


    <!-- Payment scripts -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="../assets/js/payment-process.js"></script>
    <script src="../assets/js/plugins/sweetalert.min.js"></script>

    <script src="../assets/js/sweetalert.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/core/jquery.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.9"></script>



    <script src="{{ asset('vendor/larapass/js/larapass.js') }}"></script>

    <!-- Registering credentials -->
    <script>
        $(document).ready(function() {

            // $("#referral-code-box").on('change', function() {

            //         alert('Unable to copy');


            // })

            $('#referral-code-action').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#referral-code-box').removeClass('d-none');
                    // alert("Checkbox is checked.");
                } else if ($(this).prop("checked") == false) {
                    $('#referral-code-box').addClass('d-none');
                }
            });


        });
    </script>
    <script>
        const register = (event) => {
            event.preventDefault()
            // alert(document.querySelector('input[name="_token"]').value)
            new Larapass({
                    register: 'webauthn/register',
                    registerOptions: 'webauthn/register/options'
                }).register()
                .then(response => alert('Registration successful!'))
                .catch(response => alert('Something went wrong, try again!'))
            // event.preventDefault()
            // new Larapass({
            //     login: 'webauthn/login',
            //     loginOptions: 'webauthn/login/options'
            // }).login({
            //     email: document.getElementById('email').value
            // }).then(response => alert('Authentication successful!'))
            //   .catch(error => alert('Something went wrong, try again!'))
        }


        document.getElementById('register-form').addEventListener('submit', register)
    </script>


</body>

</html>
