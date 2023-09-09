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
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.9" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
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
    <div class="page-header bg-gradient-primary  position-relative m-3 border-radius-xl">
        <img src="../assets/img/shapes/waves-white.svg" alt="pattern-lines"
            class="position-absolute opacity-6 start-0 top-0 w-100">
        <div class="container pb-lg-9 pb-10 pt-7 postion-relative z-index-2">
            <div class="row">
                <div class="col-md-6 mx-auto text-center">
                    <h3 class="text-white mt-3">Hello {{ Auth::user()->first_name }} tell us about yourself</h3>
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

            <form method="POST" action="save_personal_info" id="personal_info" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-lg-8 mb-lg-0 mb-4">
                        <div class="card">


                            <div class="card-body text-lg-start text-center">

                                <div class="row ">

                                    <div class="col-12 mb-3">
                                        <h6 class="text-lead text-center mb-2 mt-0">Confirm the order of your Name</h6>
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

                                    <div class="col-sm-4">
                                        <h5>Personal Info</h5>
                                        <div class="row mb-3">

                                            <div class="col-4">

                                                <p> DOB</p>
                                            </div>
                                            <div class="col-8">

                                                <input type="date" name="dob"
                                                    class="form-control @error('dob') is-invalid @enderror"
                                                    max="{{ date('Y-m-d') }}" value=""
                                                    placeholder="date of birth" required>
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
                                                    class="form-control @error('street') is-invalid @enderror"
                                                    name="street" required autofocus>
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
                                                    class="form-control @error('city') is-invalid @enderror"
                                                    name="city" required autofocus>
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <select class="form-control @error('state') is-invalid @enderror"
                                                    name="state" required>
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


                                        <h5>jaja Number</h5>
                                        <div class="row mb-3">

                                            <div class="col-md-12">

                                                <p class="text-sm"> Enter your jaja Number (optional)</p>

                                                <input name="jaja_number"
                                                    class="form-control @error('jaja_number') is-invalid @enderror"
                                                    placeholder="enter value here">
                                                @error('jaja_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <h5>Guarantor Info</h5>

                                        <div class="row mb-3">

                                            <div class="col-md-12">

                                                <select class="form-control" name="g_relationship" id="">
                                                    <option disabled selected>--Relationship--</option>
                                                    <option value="Father">Father</option>
                                                    <option value="Mother">Mother</option>
                                                    <option value="Brother">Brother</option>
                                                    <option value="Sister">Sister</option>
                                                    <option value="Uncle">Uncle</option>
                                                    <option value="Aunty">Aunty</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">

                                            <div class="col-md-12">

                                                <select class="form-control" name="g_suffix" id="">
                                                    <option>--Title--</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                    <option value="Prof">Prof</option>
                                                    <option value="Doc">Doc</option>
                                                    <option value="Engr">Engr</option>
                                                    <option value="Chief">Chief</option>
                                                    <option value="Alh">Alh</option>
                                                    <option value="Alj">Alj</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <input placeholder="Guardian first name" type="text"
                                                    class="form-control" name="g_first_name" autofocus>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <input placeholder="Guardian last_name" type="text"
                                                    class="form-control" name="g_last_name" autofocus>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <input placeholder="email" type="email" class="form-control"
                                                    name="g_email" autofocus>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <input placeholder="phone number" type="text" class="form-control"
                                                    name="g_phone_number" autofocus>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <input placeholder="street" type="text" class="form-control"
                                                    name="g_street" autofocus>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <input placeholder="city" type="text" class="form-control"
                                                    name="g_city" autofocus>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">

                                                <select class="form-control" name="g_state">
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
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5>School Info</h5>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <input placeholder="school" type="text"
                                                    class="form-control @error('school') is-invalid @enderror"
                                                    name="school" required value="University of Ibadan">
                                                @error('school')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <select class="form-control @error('level') is-invalid @enderror"
                                                    required name="level" id="">
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
                                                    class="form-control @error('course') is-invalid @enderror"
                                                    name="course" required autofocus>
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
                                                    class="form-control @error('faulty') is-invalid @enderror"
                                                    name="faculty" required autofocus>
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

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="photo" class="col-md-12 control-label">Admission
                                                        letter
                                                        <small class="text-grey opacity-7">(must be in pdf)</small>
                                                    </label>

                                                    <div class="col-md-12">
                                                        <input required=""
                                                            class="form-input ms-auto form-control @error('admission_letter') is-invalid @enderror"
                                                            placeholder="500" type="file" name="admission_letter"
                                                            id="admission_letter">
                                                        @error('admission_letter')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

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
                                        id="show-room-price">0.00</span> <span
                                        class="text-sm text-danger text-decoration-line-through"
                                        id="show-original-price"></span>
                                </h1>
                            </div>
                            <div class="card-body text-lg-start text-center pt-0">

                                <div class="row mb-3">
                                    <div class="col-md-12">

                                        <select onchange="loc_room()" class="form-control" name="location"
                                            id="location" required>
                                            <option disabled selected>--Location--</option>
                                            @foreach (DB::table('locations')->get() as $locations)
                                                <option value="{{ $locations->id }}">
                                                    {{ $locations->name }}
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

                                <div id="show-room-amenities">

                                </div>

                                @if (App\Models\Promo::where('active', true)->where('show', true)->count() > 0)
                                    <div class="form-check form-check-info text-left">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="promo-code-action" @if (request('ref') != null) checked @endif>
                                        <label class="form-check-label" for="promo-code-action">
                                            I have a promo code</a>
                                        </label>
                                    </div>
                                    <div id="promo-code-box"
                                        class=" @if (request('ref') == null) d-none @endif">

                                        <h5>Promo Code <span id="promo-applied" class="text-xs text-success d-none">
                                                Applied</span></h5>
                                        <span id="promo-description" class="text-sm"></span>
                                        <div class="mb-1">
                                            <input type="text"
                                                class="form-control @error('promo_code') is-invalid @enderror"
                                                name="promo_code" id="promo-code" autocomplete="promo_code">


                                        </div>
                                        <button type="button" id="check-promo-button"
                                            class="btn btn-icon btn-sm bg-gradient-dark d-lg-block mt-3 mb-0">
                                            Apply
                                        </button>
                                    </div>
                                @endif

                            </div>

                        </div>

                        <button type="submit" id="apply-button"
                            class="btn bg-gradient-dark d-lg-block mt-3 btn-block mb-0 btn-lg w-100" disabled>
                            Save Information
                            <i class="fas fa-arrow-right ms-1"></i>
                        </button>
                    </div>

                </div>
            </form>
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

    <script src="../assets/js/plugins/sweetalert.min.js"></script>
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
                        } else {
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
