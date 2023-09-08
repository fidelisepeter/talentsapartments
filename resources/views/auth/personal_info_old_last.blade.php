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
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <script src="../assets/js/sweetalert.min.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">

    <!-- End Navbar -->
    <section class="min-vh-90 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('../assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h3 class="text-white mb-2 mt-5">{{ Auth::user()->first_name }} tell us about yourself</h3>
                        <p class="text-lead text-white">You are on track to getting the best comfort, all through your
                            academic year</p>
                        <br>

                        @if ($errors->any())
                            <script>
                                swal("Error", "All Field Are Required", "error");
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Personal Info</h5>
                        </div>

                        <div class="card-body">
                            @if (count($errors) > 0)
                                <div class="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="text-danger">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="save_personal_info" id="personal_info">
                                @csrf
                                <div class="row mb-3">

                                    <div class="col-md-12">
                                        <label for="">Date of Birth</label>
                                        <input type="date" name="dob"
                                            class="form-control @error('dob') is-invalid @enderror" max="{{ date("Y-m-d") }}"
                                            value="" placeholder="date of birth" required>
                                        @error('dob')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-md-12">

                                        <select name="gender" id="gender"
                                            class="form-control @error('gender') is-invalid @enderror">
                                            <option disabled selected>--Gender--</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>

                                            @enderror

                                        </div>
                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-md-12">
                                            <input id="" placeholder="street" type="text"
                                                class="form-control @error('street') is-invalid @enderror" name="street"
                                                required autofocus>
                                            @error('street')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input placeholder="city" type="text"
                                                class="form-control @error('city') is-invalid @enderror" name="city"
                                                required autofocus>
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <select class="form-control @error('state') is-invalid @enderror" name="state"
                                                required>
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
                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                    <h5>Room Info</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-12">

                                            <select onchange="loc_room()" class="form-control" name="location"
                                                id="location" required>
                                                <option disabled selected>--Location--</option>
                                                @foreach (DB::table('locations')->get() as $locations)
                                                    <option value="{{ $locations->id }}">{{ $locations->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <select class="form-control room" name="room" id="room"
                                                name="room" required>
                                                <option disabled selected>--Room Type--</option>
                                             
                                            </select>
                                        </div>
                                    </div>
                                    <div id="show-room-details" class="d-none m-0 p-0">
                                        <div class="card" id="room-details-card">
                                            <div class="card-header d-flex pb-0 p-3">
                                                <h6 class="my-auto">Location</h6>
                                                <div class="nav-wrapper position-relative ms-auto w-50">
                                                    <ul class="nav nav-pills nav-fill p-1 flex-row" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <a class="nav-link mb-0 px-0 py-1 active"
                                                                id="show-room-location">
                                                                Loading..
                                                            </a>
                                                        </li>

                                                </div>
                                            </div>
                                            <div class="card-body p-3 mt-2">
                                                <div class="show position-relative height-200 border-radius-lg"
                                                    id="show-room-image" role="tabpanel" aria-labelledby="cam1"
                                                    style="background-image: url('../../assets/img/bg-smart-home-1.jpg'); background-size:cover;">
                                                    <div class="position-absolute d-flex top-0 w-100">
                                                        <p class="text-white p-3 mb-0">
                                                            {{ env('APP_NAME', 'Laravel') }}</p>
                                                        <div class="ms-auto p-3" id="show-room-amenities">

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card bg-gradient-primary">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8 my-auto">
                                                        <div class="numbers">
                                                            <p
                                                                class="text-white text-sm mb-0 text-capitalize font-weight-bold opacity-7">
                                                                Type</p>
                                                            <h6 class="text-white font-weight-bolder mb-0"
                                                                id="show-room-name">
                                                                Loading..
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <p
                                                            class="text-white text-sm mb-0 text-capitalize font-weight-bold opacity-7">
                                                            Price</p>
                                                        <h6 class="mb-0 text-white text-end me-1" id="show-room-price">
                                                            Loading...</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>







                                    <hr>
                                    <br>
                                    <h5>school Info</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input placeholder="school" type="text"
                                                class="form-control @error('school') is-invalid @enderror" name="school"
                                                required autofocus>
                                            @error('school')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <select class="form-control @error('level') is-invalid @enderror" required
                                                name="level" id="">
                                                <option disabled selected>--Level--</option>
                                                <option value="pre_degree">Pre Degree</option>
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="300">300</option>
                                                <option value="400">400</option>
                                                <option value="500">500</option>
                                                <option value="PostGraduate">Post Graduate</option>
                                            </select>
                                            @error('level')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input placeholder="course" type="text"
                                                class="form-control @error('course') is-invalid @enderror" name="course"
                                                required autofocus>
                                            @error('course')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input placeholder="department" type="text"
                                                class="form-control @error('department') is-invalid @enderror"
                                                name="department" required autofocus>
                                            @error('department')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input placeholder="faculty" type="text"
                                                class="form-control @error('faulty') is-invalid @enderror" name="faculty"
                                                required autofocus>
                                            @error('faculty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input placeholder="matric_number" type="text"
                                                class="form-control @error('matric_number') is-invalid @enderror"
                                                name="matric_number" required autofocus>
                                            @error('matric_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" id="apply-button" class="btn btn-primary" disabled>
                                                Apply
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <small for="">Already have an account? </small><a href="/login">click here to
                                    login</a>


                            </div>
                        </div>
                    </div>


                </div>
        </section>
        <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
        <footer class="footer py-5">
            <div class="container">
                <div class="row">

                </div>
                <div class="row">
                    <div class="col-8 mx-auto text-center mt-1">
                        <p class="mb-0 text-secondary">
                            Copyright ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Talents Apartment
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




        <script>
            $(document).ready(function() {
                // alert(JSON.stringify('data'));


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
                                // alert(JSON.stringify(data.room_details))

                                $("#show-room-details").removeClass('d-none').addClass('d-block');
                                $("#show-room-price").html(data.room_details.price);
                                $("#show-room-amenities").html(data.room_amenities);
                                $("#show-room-name").html(data.room_details.name);
                                $("#show-room-location").html(data.room_location);
                                $("#show-room-image").attr('style', "background-image: url('" + data
                                    .room_details.photo + "'); background-size:cover;");
                                $("#apply-button").attr('disabled', false);



                            } else {
                                $("#show-room-details").removeClass('block-none').addClass(
                                    'd-none');
                                // $("#show-room-price").html(data.room_details.price);
                                // $("#show-room-amenities").html(data.room_amenities);
                                // $("#show-room-name").html(data.room_details.name);
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
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    </body>

    </html>
