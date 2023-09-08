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
</head>

<body class="g-sidenav-show  bg-gray-100">
    <!-- Navbar -->
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboards/default.html">
                Talents Apartment
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
            <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">


            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <section class="min-vh-15 mb-8">
        <div class="page-header align-items-start min-vh-30 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('../assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>

        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Book a Room</h5>
                        </div>
                        <div class="row px-xl-5 px-sm-4 px-3">

                            <div class="mt-2 position-relative text-center">
                                <p
                                    class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                    choose a room type you might be interested in
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- <form method="get">
                                <div class="mb-3">
                                    <label for="">Choose Location</label>
                                    <select name="location" id="" onchange="this.form.submit()"
                                        class="form-control" aria-label="Name" aria-describedby="email-addon" required>
                                        @foreach (DB::table('locations')->get() as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </form> --}}

                            <form method="post" action="/book_a_room" enctype="multipart/form-data"
                                role="form text-left">@csrf
                                <img src="jhmb" alt="" srcset="">

                                



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
                                        <select class="form-control room" id="room"
                                            name="room_id" required>
                                            <option disabled selected>--Room Type--</option>
                                            {{-- @foreach (DB::table('rooms')->where('location', $location->id)->get()
    as $room)
                                          <option value="{{$room->id}}">{{$room->name}}</option>
                                        @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div id="show-room-details" class="d-none m-0 p-0">
                                    

                                    <div class="card">
                                        <div class="card-header text-center pt-4 pb-3">
                                           
                                            <span class="badge rounded-pill bg-light text-dark" id="show-room-name">Waiting...</span>
                                            <h1 class="font-weight-bold mt-2" >
                                                <small class="h3">N</small> <span class="h1" id="show-room-price">0.00</span>
                                            </h1>
                                        </div>
                                        <div class="card-body text-lg-start text-center pt-0">
                                            <div id="show-room-amenities">
                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                    
                                </div>


                                <input class="form-control" type="text" name="price"
                                    id="room-price" hidden>

                                {{-- <div class="mb-3">
                                    <label for=""> Proof of payment</label>
                                    <input class="form-control" type="file" required name="photo" id="">
                                </div>

                                <div class="mb-3">
                                    <label for=""> payment reference or teller number</label>
                                    <input class="form-control" type="text" required name="reference" id="">
                                </div> --}}

                                <div class="mb-3">
                                    <label for="">note (optional)</label>
                                    <textarea class="form-control" name="note" id="" cols="30" rows="5"></textarea>
                                </div>


                                <h6> Note:</h6>
                                <label for="">booking id will be sent to you email and phone number you can
                                    login to the website and submit the evidence of payments</label>
                                <br>


                                <div class="form-check form-check-info text-left">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault" checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms
                                            and Conditions</a>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <input type="submit" class="btn bg-gradient-success w-100 my-4 mb-2"
                                        value="Book this Room" />
                                </div>
                                {{-- <p class="text-sm mt-3 mb-0">If you already made a payment? <a href="javascript:;" class="text-dark font-weight-bolder">click here to proceed</a></p> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">

            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
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
                                $("#room-price").val(data.room_details.price);



                        }else{
                            $("#show-room-details").removeClass('block-none').addClass('d-none');
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
