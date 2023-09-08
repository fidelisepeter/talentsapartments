<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

{{-- @dd(request()->headers->get('referer')) --}}
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
    {{-- <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('assets/js/plugins/fontawesome-free/css/all.min.css') }}" crossorigin="anonymous" />

    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <script src="{{ asset('/assets/js/plugins/sweetalert.min.js') }}"></script>
</head>

<body class="">
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
                                    <a href="/register"
                                        class="btn btn-sm bg-gradient-info  btn-round mb-0 me-1 mt-2 mt-md-0">Register</a>

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
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">

                            <div class="d-none" id="biometric-card">

                                <div class="card mt-8">
                                    <div class="card-body text-center">
                                        <div class="info mb-4">
                                            <img class="avatar avatar-xxl" alt="Image placeholder" id="user-image"
                                                src="{{ asset('assets/img/no-pics-placeholder.jpg') }}">
                                        </div>
                                        <span class="opacity-4"> Welcome Back </span>
                                        <h4 class="mb-0"> <span class="font-weight-bolder" id="user-name">User Name
                                            </span> </h4>
                                        <p class="mb-4">Use your finger print or authenticated device to login.</p>
                                        <form role="form">
                                            <div class="mb-3 text-center">
                                                <a href="#"
                                                    class="avatar avatar-lg rounded-circle border border-dark"
                                                    id="finger-print-image">
                                                    <img alt="Image placeholder" class="p-1"
                                                        src="{{ asset('assets/img/fingerprint-ionic-authentication-android-computer-icons-png-favpng-44g6nMFmJ8dfbmJAeEAeZ6SWp.jpg') }}">
                                                </a>
                                            </div>
                                            <div class="text-center mb-2">
                                                <button type="button" class="btn btn-lg bg-gradient-dark mt-3 mb-0"
                                                    id="auth-button">Authenticate</button>
                                            </div>
                                            <div class="mb-2 position-relative text-center">
                                                <p
                                                    class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                                    or
                                                </p>
                                            </div>
                                            <div class="text-center">
                                                <a class="btn btn-link" href="#" id="logout">Logout</a>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="" id="login-card">
                                <div class="card card-plain mt-8">
                                    <div class="card-header pb-0 text-left bg-transparent">
                                        <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                        <p class="mb-0">Enter your email and password to sign in</p>

                                    </div>
                                    <div class="card-body">

                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <label>Email</label>
                                            <div class="mb-3">
                                                <input id="email" placeholder="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label>Password</label>
                                            <div class="mb-3">
                                                <input id="password"placeholder="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="rememberMe"
                                                    checked="">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn bg-gradient-info w-100 mt-4 mb-0">{{ __('Login') }}</button>

                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link"
                                                        href="{{ route('password.request') }}">forgot
                                                        password?
                                                    </a>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-4 text-sm mx-auto">
                                            Don't have an room?
                                            <a href="/register" class="text-info text-gradient font-weight-bold">Apply
                                                for
                                                a room</a>
                                        </p>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
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
                            {{ date('Y') }}
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


    <!--   Core JS Files   -->

    {{-- <script src="./dashboard-assets/js/core/modernizr-3.6.0.min.js"></script>
    <script src="./dashboard-assets/js/core/jquery-1.12.4.min.js"></script> --}}

    <script src="{{ asset('assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
    {{-- <script src="./dashboard-assets/js/core/jquery-3.3.1.min.js" type="text/javascript"></script> --}}
    <script src="./dashboard-assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="./dashboard-assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="./dashboard-assets/js/plugins/perfect-scrollbar.min.js"></script>




    <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->



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

    <script src="./dashboard-assets/js/soft-design-system.min.js?v=1.0.9" type="text/javascript"></script>

    <script src="{{ asset('vendor/webauthn/webauthn.js') }}"></script>

    <script>
        // Getting Login Page Check if Biometrics is enabled for user
        $(document).ready(function() {

            var getLoginStatus = JSON.parse(localStorage.getItem("biometrics_status"))
           


            if (getLoginStatus && getLoginStatus.status == 'activated') {
                var userEmail = getLoginStatus.email;
                $("#biometric-card").removeClass('d-none');
                $("#login-card").addClass('d-none');
                $("#user-name").text(getLoginStatus.name);
                $("#user-image").attr('src', getLoginStatus.image);
                // alert('Activated')
            }


            $('#logout').click(function() {

                localStorage.removeItem("biometrics_status");
                location.reload()

            });

            $('#finger-print-image').click(function() {

                authLogin(userEmail);
            });

            $('#auth-button').click(function() {

                authLogin(userEmail);
            });


            const authLogin = (email) => {

                new WebAuthn({
                        loginOptions: '/webauthn/login/options',
                        login: '/webauthn/login',
                    }).login({
                        email: userEmail,
                    })
                    .then(response => {
                        console.log(response);
                        const requiredButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn bg-gradient-success',
                                cancelButton: 'btn bg-gradient-danger',
                                closeButton: 'btn bg-gradient-primary'
                            },
                            buttonsStyling: false
                        })
                        requiredButtons.fire({
                            title: 'Authenticated',
                            text: 'Login successful!',
                            icon: 'success',
                            showCloseButton: true,
                        });

                        location.assign('{{ request()->headers->get('referer') }}');

                    })
                    .catch(response => {
                        const requiredButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn bg-gradient-success',
                                cancelButton: 'btn bg-gradient-danger',
                                closeButton: 'btn bg-gradient-primary'
                            },
                            buttonsStyling: false,
                        })
                        requiredButtons.fire({
                            title: 'Sorry',
                            text: 'Something went wrong, try again!',
                            icon: 'error',
                            showCloseButton: true,
                        })
                        console.log(response);


                    })

            }

        });
    </script>
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
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>
