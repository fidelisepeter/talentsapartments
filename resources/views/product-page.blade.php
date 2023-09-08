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
  <link rel="apple-touch-icon" sizes="76x76" href="./dashboard-assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./favicon.png">

  <title>
    Talents Apartment - Products
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/soft-ui-dashboard.css?v=1.0.9" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
   <!-- Navbar -->
   <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav
                class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid">
                    <a class="navbar-brand font-weight-bolder ms-sm-3"
                        href="/" rel="tooltip"
                        title="" data-placement="bottom" target="_blank">
                        <img src="/logo-transparent.png" class="navbar-brand-img h-100 rounded " alt="main_logo" style="width: 100px;">
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
                                <a Href="/" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                                    Home
                                </a>

                            </li>
                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a Href="#rooms" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                                    Rooms
                                </a>

                            </li>
                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a Href="#features" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                                    Features
                                </a>

                            </li>
                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a Href="#contact" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                                    Contact
                                </a>

                            </li>
                                
                           
                           
                            <li class="nav-item ms-lg-auto my-auto ms-3 ms-lg-0">
                                <a href="/login"
                                class="btn btn-sm bg-gradient-info  btn-round mb-0 me-1 mt-2 mt-md-0">Login</a>
                        
                               
                                <a href="https://api.whatsapp.com/send/?phone=2348069578636&text&type=phone_number&app_absent=0"
                                class="btn btn-sm bg-gradient-success  btn-round mb-0 me-1 mt-2 mt-md-0">WhatsApp</a>
                                
                                
                               <a data-bs-toggle="modal" data-bs-target="#call-me-back"
                                class="btn btn-sm  bg-gradient-dark  btn-round mb-0 me-1 mt-2 mt-md-0">Call Me Back</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>




















  <!-- -------- START HEADER 7 w/ text and video ------- -->
  <header class="bg-grey">
    <div class="page-header min-vh-50" style="background-image: url('../assets/img/office-dark.jpg');">
      <span class="mask bg-gradient-info opacity-8"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center mx-auto my-auto">
            <h1 class="text-white"><span>Affordable</span> Student <span>Apartment</span></h1>
            {{-- <p class="lead mb-4 text-white opacity-8">Room Price as fare as posible <br> Enjoys wider possibilities</p>
            <a href="/profile" class="btn bg-white text-dark">Login to Dashboard</a> --}}
            {{-- <h6 class="text-white mb-2 mt-5">Find us on</h6> --}}
            {{-- <div class="d-flex justify-content-center">
              <a href="javascript:;"><i class="fab fa-facebook text-lg text-white me-4"></i></a>
              <a href="javascript:;"><i class="fab fa-instagram text-lg text-white me-4"></i></a>
              <a href="javascript:;"><i class="fab fa-twitter text-lg text-white me-4"></i></a>
              <a href="javascript:;"><i class="fab fa-google-plus text-lg text-white"></i></a>
            </div> --}}
          </div>
        </div>
      </div>
      <div class="position-absolute w-100 z-index-1 bottom-0">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
          <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
          </defs>
          <g class="moving-waves">
            <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
            <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
            <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
            <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,1" />
          </g>
        </svg>
      </div>
    </div>
  </header>
  <!-- -------- END HEADER 7 w/ text and video ------- -->
      
      
      <section class="pt-5 pb-4" id="count-stats">
        <div class="container">
            <div class="row">
                @foreach (DB::table('rooms')->get() as $room_type)
                @if ($room_type->show_in_site)
                <div class="col-lg-4 mb-lg-4 mb-4">
                  <div class="card  @if ($room_type->status != 'available') border-1 border-danger  blur blur-10 shadow-blur @endif shadow-lg">
                    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                      <div class="d-block blur-shadow-image">
                        <img src="{{$room_type->photo}}" alt="img-blur-shadow" class="img-fluid shadow rounded-3">
                      </div>
                      <div class="colored-shadow" style="background-image: url('{{$room_type->photo}}');"></div>
                      </div>
                      <div class="card-body">
                      <a href="javascript:;">
                      <h4 class="mt-0">
                        {{$room_type->name}} @if ($room_type->status != 'available') <span class="text-danger text-xs">Unavailable</span>  @endif
                       <span class="text-dark opacity-7" style="float: right;">
                        <small>₦</small>{{number_format($room_type->price)}}
                       </span>
                      </h4>
                      </a>
                      <p>
                        {{ DB::table('locations')->where('id', $room_type->location)->value('name') }}
                      </p>
                      <div class="text-lg-start text-center pt-3">
                        @if (!empty($room_type->amenity1))
                        <div class="d-flex justify-content-lg-start justify-content-center p-2">
                            <div class="icon icon-shape icon-xs rounded-circle bg-success shadow text-center">
                              <i class="fas fa-check opacity-10"></i>
                            </div>
                            <div>
                              <span class="ps-3 text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity1)->value('name') }}</span>
                            </div>
                          </div>
                       
                          @endif
                          @if (!empty($room_type->amenity2))
                        <div class="d-flex justify-content-lg-start justify-content-center p-2">
                            <div class="icon icon-shape icon-xs rounded-circle bg-success shadow text-center">
                              <i class="fas fa-check opacity-10"></i>
                            </div>
                            <div>
                              <span class="ps-3 text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity2)->value('name') }}</span>
                            </div>
                          </div>
                       
                          @endif
    
                          @if (!empty($room_type->amenity3))
                          <div class="d-flex justify-content-lg-start justify-content-center p-2">
                              <div class="icon icon-shape icon-xs rounded-circle bg-success shadow text-center">
                                <i class="fas fa-check opacity-10"></i>
                              </div>
                              <div>
                                <span class="ps-3 text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity3)->value('name') }}</span>
                              </div>
                            </div>
                         
                            @endif
                            @if (!empty($room_type->amenity4))
                            <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                <div class="icon icon-shape icon-xs rounded-circle bg-success shadow text-center">
                                  <i class="fas fa-check opacity-10"></i>
                                </div>
                                <div>
                                  <span class="ps-3 text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity4)->value('name') }}</span>
                                </div>
                              </div>
                           
                              @endif
                              @if (!empty($room_type->amenity5))
                              <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                  <div class="icon icon-shape icon-xs rounded-circle bg-success shadow text-center">
                                    <i class="fas fa-check opacity-10"></i>
                                  </div>
                                  <div>
                                    <span class="ps-3 text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity5)->value('name') }}</span>
                                  </div>
                                </div>
                             
                                @endif
                                @if (!empty($room_type->amenity6))
                                <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                    <div class="icon icon-shape icon-xs rounded-circle bg-success shadow text-center">
                                      <i class="fas fa-check opacity-10"></i>
                                    </div>
                                    <div>
                                      <span class="ps-3 text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity6)->value('name') }}</span>
                                    </div>
                                  </div>
                            
                                @endif
                                @if (!empty($room_type->amenity7))
                                <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                    <div class="icon icon-shape icon-xs rounded-circle bg-success shadow text-center">
                                    <i class="fas fa-check opacity-10"></i>
                                    </div>
                                    <div>
                                    <span class="ps-3 text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity7)->value('name') }}</span>
                                    </div>
                                </div>
                                
                                @endif
                                @if (!empty($room_type->amenity8))
                                <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                    <div class="icon icon-shape icon-xs rounded-circle bg-success shadow text-center">
                                        <i class="fas fa-check opacity-10"></i>
                                    </div>
                                    <div>
                                        <span class="ps-3 text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity8)->value('name') }}</span>
                                    </div>
                                    </div>
                                
                                    @endif
                                    @if (!empty($room_type->amenity9))
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <div class="icon icon-shape icon-xs rounded-circle bg-success shadow text-center">
                                        <i class="fas fa-check opacity-10"></i>
                                        </div>
                                        <div>
                                        <span class="ps-3 text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity9)->value('name') }}</span>
                                        </div>
                                    </div>
                                    
                                    @endif
                                    @if (!empty($room_type->amenity10))
                                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                        <div class="icon icon-shape icon-xs rounded-circle bg-success shadow text-center">
                                            <i class="fas fa-check opacity-10"></i>
                                        </div>
                                        <div>
                                            <span class="ps-3 text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity10)->value('name') }}</span>
                                        </div>
                                        </div>
                                    
                                        @endif
                        
                       
                        <a href="/register" class="btn btn-icon bg-gradient-primary d-lg-block mt-3 mb-0" style="">
                          Book Now
                          <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                      </div>
                      </div>
                    </div>
                  
                </div>
                @endif
                @endforeach
                
              </div>
            </div>
      </section>

  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer mt-5 py-5 bg-gradient-info position-relative overflow-hidden">
    <hr class="horizontal text-white light mb-5">
    {{-- <img src="../assets/img/shapes/waves-white.svg" alt="pattern-lines" class="position-absolute start-0 top-0 w-100 opacity-6"> --}}
    <div class="container">
        <div class=" row">
            <div class="col-md-5 mb-4 ms-auto">
                <div>
                    <h6 class="text-white font-weight-bolder">Talents Apartment</h6>
                </div>
                <div>
                    <h6 class="text-white mt-3 mb-2 ">Social</h6>
                    <ul class="d-flex flex-row ms-n3 nav">
                        {{-- <li class="nav-item">
                            <a class="nav-link text-white pe-1" href="mailto:reservations@talentsapartments.com" target="_blank">
                                <i class="fas fa-envelope text-lg "></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white pe-1" href="tel:+234 902 8814 649" target="_blank">
                                <i class="fas fa-phone text-lg "></i>
                                
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link text-white pe-1" href="">
                                <i class="fab fa-facebook text-lg "></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white pe-1" href="https://api.whatsapp.com/send/?phone=27647579638&text&type=phone_number&app_absent=0" target="_blank">
                                <i class="fab fa-whatsapp text-lg "></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white pe-1" href="">
                                <i class="fab fa-twitter text-lg "></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white pe-1" href="">
                                <i class="fab fa-instagram text-lg "></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>



            <div class="col-md-2  col-6 mb-4">
                <div>
                    <h6 class="text-white text-sm">Site</h6>
                    <ul class="flex-column ms-n3 nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/" target="_blank">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/login" target="_blank">
                                Login
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="/#rooms" target="_blank">
                                Rooms
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="/#features"
                                target="_blank">
                                Features
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="/#contact" target="_blank">
                                Contact Us
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>

            <div class="col-md-3  col-6 mb-4">
                <div>
                    <h6 class="text-white text-sm">Contact Info</h6>
                    <ul class="flex-column ms-n3 nav">
                        <li class="nav-item">
                            <span class="nav-link text-white">Phone :</span>
                            <p class="nav-link text-white py-0 my-0">+234 806 9578 636</p>
                            <p class="nav-link text-white py-0 my-0">+234 810 5446 372</p>
                                   
                        </li>

                        <li class="nav-item mt-3">
                            <span class="nav-link text-white">Email :</span>
                            <p class="nav-link text-white py-0 my-0">reservations@talentsapartments.com</p>
                            <p class="nav-link text-white py-0 my-0">complaints@talentsapartments.com</p>
                                   
                        </li>
                    </ul>
                </div>
            </div>

            
            <div class="col-md-2  col-6 mb-4 me-auto">
                <div>
                    <h6 class="text-white text-sm">Address</h6>
                    <ul class="flex-column ms-n3 nav">
                        <li class="nav-item">
                            <p class="nav-link text-white">
                                No 6 NASU street , Agbowo Ibadan Oyo state
                            </p>
                        </li>

                        
                    </ul>
                </div>
            </div>

            <div class="col-12">
                <div class="text-center">
                    <p class="text-white my-4 text-sm">
                        All rights reserved. Copyright ©
                        <script>document.write(new Date().getFullYear())</script> Talents Apartment by <a
                            href="http://alresia.com" target="_blank">Alresia Inc</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" id="call-me-back">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Call Me Back</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            <form class="form-horizontal" method="POST" action="/call-me-back"
                enctype="multipart/form-data">
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
                        <input type="text" class="form-control"  name="name" placeholder="Enter Your Name" data-error="Name is required." required="required">
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="single-form form-group mt-3">
                        <input type="email" class="form-control"  name="email" placeholder="Email" data-error="Name is required." required="required">
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="single-form form-group mt-3">
                        <input type="tel" class="form-control"  name="phone" placeholder="Phone" data-error="Name is required." required="required">
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="single-form form-group">
                        <button class="btn btn-sm  bg-gradient-info  btn-round mb-0 me-1 mt-2 mt-md-0" type="submit">Call Me Back</button>
                        <button type="button" class="btn btn-sm bg-gradient-dark btn-round mb-0 me-1 mt-2 mt-md-0" data-bs-dismiss="modal">Close</button>
      
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
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Kanban scripts -->
  <script src="./assets/js/plugins/dragula/dragula.min.js"></script>
  <script src="./assets/js/plugins/jkanban/jkanban.js"></script>
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
  <script src="./assets/js/soft-ui-dashboard.min.js?v=1.0.9"></script>
</body>

</html>