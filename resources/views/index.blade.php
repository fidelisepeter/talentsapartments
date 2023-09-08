<!--
=========================================================
* Talents Apartment - v1.0.9
=========================================================

* Product Page:  https://www.creative-tim.com/product/soft-ui-design-system
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>





    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="./dashboard-assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./favicon.png">

    <title>



        Talents Apartment - Home


    </title>



    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons -->
    <link href="./dashboard-assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./dashboard-assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="./dashboard-assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- CSS Files -->



    <link id="pagestyle" href="./dashboard-assets/css/soft-design-system.css?v=1.0.9" rel="stylesheet" />

    <style>
        .carousel-item {
            height: 100vh;
            min-height: 350px;
            background: no-repeat center center scroll;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

</head>

<body class="index-page">


    <!-- Navbar -->
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav
                    class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid">
                        <a class="navbar-brand font-weight-bolder ms-sm-3" href="" rel="tooltip" title=""
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
                                    <a Href="#rooms"
                                        class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                                        Rooms
                                    </a>

                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a Href="#features"
                                        class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                                        Features
                                    </a>

                                </li>
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a Href="#contact"
                                        class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                                        Contact
                                    </a>

                                </li>


                                <li class="nav-item ms-lg-auto my-auto ms-3 ms-lg-0">
                                    <a href="/login"
                                        class="btn btn-sm bg-gradient-info  btn-round mb-0 me-1 mt-2 mt-md-0">Login</a>

                                    <a href="https://api.whatsapp.com/send/?phone=27647579638&text&type=phone_number&app_absent=0"
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



















    {{-- <header class="header-2">
        <div class="page-header min-vh-100">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                    style="background-image:url('./assets/img/492699342-170667a.jpg')"></div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7 d-flex justify-content-center flex-column">
                        <h1 class=""> 
                            <span class="text-gradient text-info">Affordable</span> 
                            <span class="text-gradient text-info">PREMIUM</span>
                        </h1>
                        <h1 class="mb-4">Student Accomodation</h1>
                        <p class="lead pe-5 me-5 text-sm" data-animation="fadeInUp" data-delay="0.9s" style="animation-delay: 0.9s;">
                            Since 2015, the Talents Apartments  team has focused on perfecting our services and amenities to ensure that you can student better. Whichever of our residences you choose, you’ll find that along with cosy accommodation, excellent security and convenience, you benefit from a unique living-learning lifestyle and a vibrant student community.
                            Each apartment has been thoughtfully designed with you in mind. You get the best of both worlds – private living space with the option to connect with others.
                           A state-of-the-art apartment complex for students who insist on the best. Designed to meet modern-day needs, Talents Apartments is stylishly furnished rooms, social and study facilities with incredible views, the most desirable student residence in Nigeria.
                        </p>
                        
                        <div class="buttons">
                            <a href="/register" class="btn bg-gradient-info mt-4">Get Started</a>
                            <a href="/login" class="btn text-info shadow-none mt-4">Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header> --}}
    <header class="header-2">

        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                    class="btn-info active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class="btn-info"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" class="btn-info"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" style="">
                    <div class=" page-header min-vh-100">
                        {{-- <div class="oblique position-absolute top-0 h-100 d-md-block d-none">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="background-image:url('./assets/img/492699342-170667a.jpg')"></div>
                        </div> --}}
                        <div class="container">
                            <img src="{{ asset('assets/img/season-greetings.jpeg')}}" alt="" style="animation-delay: 0.9s; width: 100%">
                            {{-- <div class="row">
                                <div class="col-lg-6 col-md-7 d-flex justify-content-center flex-column">
                                    <h1 class="">
                                        <span class="text-gradient text-info">Affordable</span>
                                        <span class="text-gradient text-info">PREMIUM</span>
                                    </h1>
                                    <h1 class="mb-4">Student Accomodation</h1>
                                    <p class="lead pe-5 me-5 text-sm" data-animation="fadeInUp" data-delay="0.9s"
                                        style="animation-delay: 0.9s;">
                                        Since 2015, the Talents Apartments team has focused on perfecting our services
                                        and amenities to ensure that you can student better. Whichever of our residences
                                        you choose, you’ll find that along with cosy accommodation, excellent security
                                        and convenience, you benefit from a unique living-learning lifestyle and a
                                        vibrant student community.
                                    </p>

                                    <div class="buttons">
                                        <a href="/register" class="btn bg-gradient-info mt-4">Get Started</a>
                                        <a href="/login" class="btn text-info shadow-none mt-4">Dashboard</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="">
                    <div class=" page-header min-vh-100">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="background-image:url('./assets/img/492699342-170667a.jpg')"></div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-7 d-flex justify-content-center flex-column">
                                    <h1 class="">
                                        <span class="text-gradient text-info">Affordable</span>
                                        <span class="text-gradient text-info">PREMIUM</span>
                                    </h1>
                                    <h1 class="mb-4">Student Accomodation</h1>
                                    <p class="lead pe-5 me-5 text-sm" data-animation="fadeInUp" data-delay="0.9s"
                                        style="animation-delay: 0.9s;">
                                        Since 2015, the Talents Apartments team has focused on perfecting our services
                                        and amenities to ensure that you can student better. Whichever of our residences
                                        you choose, you’ll find that along with cosy accommodation, excellent security
                                        and convenience, you benefit from a unique living-learning lifestyle and a
                                        vibrant student community.
                                    </p>

                                    <div class="buttons">
                                        <a href="/register" class="btn bg-gradient-info mt-4">Get Started</a>
                                        <a href="/login" class="btn text-info shadow-none mt-4">Dashboard</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="">
                    <div class=" page-header min-vh-100">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="background-image:url('./assets/img/164560386.jpg')"></div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-7 d-flex justify-content-center flex-column">
                                    <h1 class="">
                                        <span class="text-gradient text-info">Decide </span>
                                        <span class="text-gradient text-info">WHO YOU</span>
                                    </h1>
                                    <h1 class="mb-4">Leave with Convinient</h1>

                                    <p class="lead pe-5 me-5 text-sm" data-animation="fadeInUp" data-delay="0.9s"
                                        style="animation-delay: 0.9s;">
                                        Each apartment has been thoughtfully designed with you in mind. You get the best
                                        of both worlds – private living space with the option to connect with others.
                                    </p>

                                    <div class="buttons">
                                        <a href="/register" class="btn bg-gradient-info mt-4">Book Now</a>
                                        {{-- <a href="/login" class="btn text-info shadow-none mt-4">Dashboard</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="">
                    <div class=" page-header min-vh-100">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="background-image:url('./assets/img/bg-smart-home-1.jpg')"></div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-7 d-flex justify-content-center flex-column">
                                    <h1 class="">
                                        <span class="text-gradient text-info">PREMIUM</span>
                                        <span class="text-gradient text-dark">&</span>
                                    </h1>
                                    <h1 class="mb-4">SAFE</h1>
                                    <p class="lead pe-5 me-5 text-sm" data-animation="fadeInUp" data-delay="0.9s"
                                        style="animation-delay: 0.9s;">
                                        A state-of-the-art apartment complex for students who insist on the best.
                                        Designed to meet modern-day needs, Talents Apartments is stylishly furnished
                                        rooms, social and study facilities with incredible views, the most desirable
                                        student residence in Nigeria.
                                    </p>

                                    <div class="buttons">
                                        <a href="/product-page" class="btn bg-gradient-info mt-4">All Rooms</a>
                                        <a href="/login" class="btn text-info shadow-none mt-4">Dashboard</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="buttons" style="position: absolute;bottom: 0px;left: 318px;">
           <ul class="pagination pagination-info m-4">
      <li class="page-item">
        <a class="page-link"  type="a" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true" ><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
            <span class="visually-hidden">Previous</span>
        </a>
      </li>
      
      <li class="page-item">
        <a class="page-link"  type="a" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
          <span class="visually-hidden">Next</span>
        </a>
      </li>
    </ul>
        </div> --}}

        </div>
    </header>

    <!-- -------- END HEADER 1 w/ text and image on right ------- -->
    <!-- <section class="pt-3 pb-4" id="count-stats">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 z-index-2 border-radius-xl mt-n10 mx-auto py-3 blur shadow-blur">
                <div class="row">
                    <div class="col-md-4 position-relative">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-info"><span id="state1" countTo="70">0</span>+</h1>
                            <h5 class="mt-3">Coded Elements</h5>
                            <p class="text-sm">From buttons, to inputs, navbars, alerts or cards, you are covered
                            </p>
                        </div>
                        <hr class="vertical dark">
                    </div>
                    <div class="col-md-4 position-relative">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-info"> <span id="state2" countTo="15">0</span>+</h1>
                            <h5 class="mt-3">Design Blocks</h5>
                            <p class="text-sm">Mix the sections, change the colors and unleash your creativity</p>
                        </div>
                        <hr class="vertical dark">
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-info" id="state3" countTo="4">0</h1>
                            <h5 class="mt-3">Pages</h5>
                            <p class="text-sm">Save 3-4 weeks of work when you use our pre-made pages for your
                                website</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
    <section class="pt-3 pb-4" id="count-stats">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 z-index-2 border-radius-xl mt-n7 mx-auto py-3 blur shadow-blur">
                    <div class="row">
                        <div class="col-md-3 position-relative">
                            <div class="p-3 text-center">
                                <h3 class="text-gradient text-info"><span id="state1" countto="{{ App\Models\BedSpace::count() }}">{{ App\Models\BedSpace::count() }}</span>
                                </h3>
                                <h6 class="mt-3">Bedspaces</h6>
                                {{-- <p class="text-sm">From buttons, to inputs, navbars, alerts or cards, you are covered</p> --}}
                            </div>
                            <hr class="vertical dark">
                        </div>
                        <div class="col-md-3 position-relative">
                            <div class="p-3 text-center">
                                <h3 class="text-gradient text-info"> <span id="state2" countto="{{ DB::table('locations')->count() }}">{{ DB::table('locations')->count() }}</span>
                                </h3>
                                <h6 class="mt-3">Location</h6>
                                {{-- <p class="text-sm">Mix the sections, change the colors and unleash your creativity</p> --}}
                            </div>
                            <hr class="vertical dark">
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 text-center">
                                <h3 class="text-gradient text-info" id="state3" countto="{{ App\Models\BedSpace::whereNotNull('user_id')->where('allocated', true)->count() }}">{{ App\Models\BedSpace::whereNotNull('user_id')->where('allocated', true)->count() }}</h3>
                                <h6 class="mt-3">Bedspace Occupacy</h6>
                                {{-- <p class="text-sm">Save 3-4 weeks of work when you use our pre-made pages for your website</p> --}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 text-center">
                                <h3 class="text-gradient text-info" id="state34" countto="44">44</h3>
                                <h6 class="mt-3">Customer Satisfaction</h6>
                                {{-- <p class="text-sm">Save 3-4 weeks of work when you use our pre-made pages for your website</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container text-center">


            <div class="d-inline-flex">
                <div class="px-5 flex-fill">
                    <a href="mailto:reservations@talentsapartments.com">
                        <img class="w-100 opacity-6" style="filter: grayscale(); max-width: 100px;"
                            src="./dashboard-assets/img/alresia-logos/email-svg-alresia-inc.svg" alt="Logo">
                    </a>
                </div>
                <div class="px-5 flex-fill">
                    <a href="tel:+234 902 8814 649">
                        <img class="w-100 opacity-6" style="filter: grayscale(); max-width: 96px;"
                            src="./dashboard-assets/img/alresia-logos/call-us-svg-alresia-inc.svg" alt="Logo">
                    </a>
                </div>

                <div class="px-5 flex-fill">
                    <a href="https://api.whatsapp.com/send/?phone=27647579638&text&type=phone_number&app_absent=0">
                        <img class="w-100 opacity-6" style="filter: grayscale(); max-width: 110px;"
                            src="./dashboard-assets/img/alresia-logos/whatsapp-svg-alresia-inc.svg" alt="Logo">
                    </a>
                </div>

            </div>
            <hr class="horizontal dark mt-5">

        </div>
    </section>


    <!-- START Section Content W/ 2 images aside of icon title description -->
    <section id="features" class="pt-lg-7 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-8 order-2 order-md-2 order-lg-1">
                    <div
                        class="position-relative ms-lg-5 mb-0 mb-md-7 mb-lg-0 d-none d-md-block d-lg-block d-xl-block h-75">
                        <div class="bg-gradient-info w-100 h-100 border-radius-xl position-absolute d-lg-block d-none">
                        </div>
                        <img src="./dashboard-assets/img/istockphoto-1310367561-612x612.jpg"
                            class="w-100 border-radius-xl mt-6 ms-lg-5 position-relative z-index-5" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 ms-auto order-1 order-md-1 order-lg-1">
                    <div class="p-3 pt-0 pb-0">

                        <h3 class="mb-4"><span class="font-weight-bolder text-gradient text-info ">Features</span>
                            <span class="text-sm">What You will Enjoy</span>
                        </h3>

                        <!-- <div class="p-3 info-horizontal">
                                <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                  <i class="fas fa-solid fa-wifi opacity-10"></i>
                                </div>
                                <div class="description ps-3">
                                    <p class="mb-0">Wifi Access</p>
                                  </div>
                              </div>
                      
                              <div class="p-3 info-horizontal">
                                <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                  <i class="fas fa-lightbulb opacity-10"></i>
                                </div>
                                <div class="description ps-3">
                                  <p class="mb-0">Backup light.</p>
                                </div>
                              </div>
                              <div class="p-3 info-horizontal">
                                <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                  <i class="fa fa-internet-explorer opacity-10"></i>
                                </div>
                                <div class="description ps-3">
                                  <p class="mb-0">Free High-Speed Internet.</p>
                                </div>
                              </div>
                              <div class="p-3 info-horizontal">
                                <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                  <i class="fa fa-location-dot opacity-10"></i>
                                </div>
                                <div class="description ps-3">
                                  <p class="mb-0">Conveniently Located.</p>
                                </div>
                              </div>
                              <div class="p-3 info-horizontal">
                                <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                  <i class="fas fa-fingerprint opacity-10"></i>
                                </div>
                                <div class="description ps-3">
                                  <p class="mb-0">Biometric Access.</p>
                                </div>
                              </div> -->
                        <div class="row justify-content-start">
                            <div class="col-md-4 h-100">
                                <div class="info bg-gray-100 border-radius-xl p-3 text-center">
                                    <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                        <i class="fas fa-solid fa-tv opacity-10"></i>
                                    </div>
                                    <h6 class="font-weight-bolder mt-3">TV Room</h6>


                                </div>
                            </div>
                            <div class="col-md-4 h-100">
                                <div class="info bg-gray-100 border-radius-xl p-3 text-center">
                                    <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                        <i class="fas fa-layer-group opacity-10"></i>
                                    </div>

                                    <h6 class=" mt-3">Study Room</h6>

                                </div>
                            </div>
                            <div class="col-md-4 h-100">
                                <div class="info bg-gray-100 border-radius-xl p-3 text-center">
                                    <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                        <i class="fas fa-poo-storm opacity-10"></i>
                                    </div>

                                    <h6 class=" mt-3">Laundry</h6>

                                </div>
                            </div>

                        </div>

                        <div class="row justify-content-start mt-3">
                            <div class="col-md-4 h-100">
                                <div class="info bg-gray-100 border-radius-xl p-3 text-center">
                                    <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                        <i class="fas fa-fingerprint opacity-10"></i>
                                    </div>
                                    <h6 class=" mt-3">Safe and Secure</h6>
                                </div>
                            </div>
                            <div class="col-md-4 h-100">
                                <div class="info bg-gray-100 border-radius-xl p-3 text-center">
                                    <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                        {{-- <i class="fas fa-shield-halved"></i> --}}
                                        <i class="fas fa-solid fa-table opacity-10"></i>
                                    </div>
                                    <h6 class=" mt-3">Lockable Cupboards</h6>
                                </div>
                            </div>
                            <div class="col-md-4 h-100">
                                <div class="info bg-gray-100 border-radius-xl p-3 text-center">
                                    <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                        <i class="fas fa-lightbulb opacity-10"></i>
                                    </div>

                                    <h6 class=" mt-3">LED Lighting</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-start mt-3">
                            <div class="col-md-4 h-100">
                                <div class="info bg-gray-100 border-radius-xl p-3 text-center">
                                    <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                        <!-- <i class="fas fa-location-dot "></i> -->
                                        <i class="fa fa-map-marker "></i>
                                    </div>
                                    <h6 class=" mt-3">Prime Location.</h6>


                                </div>
                            </div>

                            <div class="col-md-4 h-100">
                                <div class="info bg-gray-100 border-radius-xl p-3 text-center">
                                    <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                        <i class="fas fa-server opacity-10"></i>
                                    </div>
                                    <h6 class=" mt-3">Backup Power</h6>


                                </div>
                            </div>
                            <div class="col-md-4 h-100">
                                <div class="info bg-gray-100 border-radius-xl p-3 text-center">
                                    <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                        <i class="fas fa-users opacity-10"></i>
                                    </div>

                                    <h6 class=" mt-3">Roommate Matching</h6>

                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-start mt-3">
                            <div class="col-md-12 h-100">
                                <div class="info bg-gray-100 border-radius-xl p-3 text-center">
                                    <div class="icon icon-shape rounded-circle bg-gradient-info shadow text-center">
                                        <!-- <i class="fas fa-location-dot "></i> -->
                                        <i class="fa fa-landmark "></i>
                                    </div>
                                    <h6 class=" mt-3">Professional On-Site Management</h6>


                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END Section Content -->

    <!-- -------- START Features w/ pattern background & stats & rocket -------- -->
    <!-- <header class="bg-gradient-dark">
    <div class="page-header min-vh-75" style="background-image: url('../dashboard-assets/img/office-dark.jpg');">
      <span class="mask bg-gradient-info opacity-8"></span>
      <div class="container"> -->

    <section id="rooms" class="pt-sm-8 pb-5 position-relative bg-gradient-dark"
        style="background-image: url('./dashboard-assets/img/office-dark.jpg');">
        <span class="mask bg-gradient-info opacity-8"></span>
        <div class="position-absolute w-100 z-inde-1 top-0 mt-n3">

            <svg width="100%" viewBox="0 -2 1920 157" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>wave-down</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g fill="#FFFFFF" fill-rule="nonzero">
                        <g id="wave-down">
                            <path
                                d="M0,60.8320331 C299.333333,115.127115 618.333333,111.165365 959,47.8320321 C1299.66667,-15.5013009 1620.66667,-15.2062179 1920,47.8320331 L1920,156.389409 L0,156.389409 L0,60.8320331 Z"
                                id="Path-Copy-2"
                                transform="translate(960.000000, 78.416017) rotate(180.000000) translate(-960.000000, -78.416017) ">
                            </path>
                        </g>
                    </g>
                </g>
            </svg>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-start mb-5 mt-5">
                    <h3 class="text-white z-index-1 position-relative">All Our Rooms</h3>
                    <p class="text-white opacity-8 mb-0">Talents Apartments offers premium, safe student accommodation
                        with a unique hospitality approach to service, for total peace of mind. Our two locations are
                        conveniently located inside and outside of the University of Ibadan depending on your needs.</p>
                    <p class="text-white opacity-8 mb-0">Each Apartment consists between 4 to 6 fully furnished and
                        self-contained apartments, each with a private bathroom and kitchen. Private rooms combined with
                        communal studying, social and entertainment spaces, ensuring students enjoy total privacy within
                        a vibrant student environment.
                    </p>
                    <p class="text-white opacity-8 mb-0">A fully functional kitchen equipped with lockers, and a table
                        and chairs to enjoy meals. Bedrooms are furnished with a single bed mattress, storage built-in
                        cupboard, desk, chair and others.
                        Also each has its own private shower, a toilet, and a basin.</p>
                    <p class="text-white opacity-8 mb-0">Comfortable communal areas offer laundry facilities, Wi-Fi,
                        spaces to share ideas and experiences with other students, and direct access to the building.
                        Resident Managers ensure all necessities are taken care of so you can focus on your studies.</p>

                </div>
            </div>
            <div class="row">

            </div>
            <div class="row">
                @foreach (DB::table('rooms')->get() as $room_type)
                    @if ($room_type->show_in_site)
                        <div class="col-lg-6 col-12 mb-4">
                            <div class="card @if ($room_type->status != 'available') border-1 border-danger  blur blur-10 shadow-blur @endif card-profile overflow-hidden z-index-2">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 pe-lg-0">
                                        <a href="javascript:;">
                                            <div class="p-3 pe-md-0">
                                                <img class="w-100 border-radius-md" src="{{ $room_type->photo }}"
                                                    alt="image" style="height: 170px;">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-12 ps-lg-0 my-auto">
                                        <div class="card-body">
                                            <h5 class="mb-0">{{ $room_type->name }} @if ($room_type->status != 'available')
                                                    <span class="text-danger text-xs">Unavailable</span>
                                                @endif
                                            </h5>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span
                                                        class="h6 text-info"><small>₦</small>{{ number_format($room_type->price) }}</span>

                                                </div>
                                                <div class="col-auto">
                                                    <span class="text-xs opacity-8">Location:</span>
                                                    <span
                                                        class="text-xs text-dark font-weight-bold">{{ DB::table('locations')->where('id', $room_type->location)->value('name') }}</span>
                                                </div>

                                            </div>
                                            <p class="mb-0 text-xs">{{ $room_type->detail }}</p>
                                            <a href="/product-page" class="text-info icon-move-right">Details
                                                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
        <div class="position-absolute w-100 bottom-0 mn-n1">
            <svg width="100%" viewBox="0 -1 1920 166" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>wave-up</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(0.000000, 5.000000)" fill="#FFFFFF" fill-rule="nonzero">
                        <g id="wave-up" transform="translate(0.000000, -5.000000)">
                            <path
                                d="M0,70 C298.666667,105.333333 618.666667,95 960,39 C1301.33333,-17 1621.33333,-11.3333333 1920,56 L1920,165 L0,165 L0,70 Z"
                                fill="#f8f9fa"></path>
                        </g>
                    </g>
                </g>
            </svg>
        </div>
    </section>
    <!-- -------- END Features w/ pattern background & stats & rocket -------- -->

    <!-- END Blogs w/ 4 cards w/ image & text & link -->
    <section id="contact" class="py-lg-7 pt-2 pb-6 bg-gray-100">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card overflow-hidden mb-5">
                        <div class="row">
                            <div class="col-lg-7">
                                <form class="p-3" id="contact-form" action="/send_contact_mail" method="post">
                                    @csrf
                                    <div class="card-header px-4 py-sm-5 py-3">
                                        <h2>Get In Touch</h2>
                                        <p class="lead">We'd like to talk with you.</p>
                                    </div>
                                    <div class="card-body pt-1">
                                        <div class="row">
                                            <div class="col-md-12 pe-2 mb-3">
                                                <label>Your Name</label>
                                                <input name="name" class="form-control" placeholder="Full Name"
                                                    type="text" required>
                                            </div>
                                            <div class="col-md-12 pe-2 mb-3">
                                                <label>Your Email</label>
                                                <input name="email" class="form-control"
                                                    placeholder="Email Address" type="text" required>
                                            </div>
                                            <div class="col-md-12 pe-2 mb-3">
                                                <div class="form-group mb-0">
                                                    <label>Your message</label>
                                                    <textarea name="message" class="form-control" id="message" rows="6" placeholder="I want to say that..."
                                                        required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 text-end ms-auto">
                                                <button type="submit"
                                                    class="btn btn-round bg-gradient-info mb-0">Send
                                                    Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-5 position-relative bg-cover px-0"
                                style="background-image: url('./dashboard-assets/img/curved-images/curved5.jpg')">
                                <div class="position-absolute z-index-2 w-100 h-100 top-0 start-0 d-lg-block d-none">
                                    <img src="./dashboard-assets/img/wave-1.svg" class="h-100 ms-n2"
                                        alt="vertical-wave">
                                </div>
                                <div
                                    class="z-index-2 text-center d-flex h-100 w-100 d-flex m-auto justify-content-center">
                                    <div class="mask bg-gradient-info opacity-9"></div>
                                    <div class="p-5 ps-sm-8 position-relative text-start my-auto z-index-2">
                                        <h3 class="text-white">Contact Information</h3>
                                        <p class="text-white opacity-8 mb-4">Fill up the form and our Team will get
                                            back
                                            to you within 24 hours.</p>
                                        <div class="d-flex p-2 text-white">
                                            <div>
                                                <i class="fas fa-phone text-sm"></i>
                                            </div>
                                            <div class="ps-3">
                                                <span class="text-sm opacity-8"> (+234) 806 9578 636</span><br>
                                                <span class="text-sm opacity-8"> (+234) 810 5446 372</span>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2 text-white">
                                            <div>
                                                <i class="fas fa-envelope text-sm"></i>
                                            </div>
                                            <div class="ps-3">
                                                <span
                                                    class="text-sm opacity-8">reservations@talentsapartments.com</span>
                                            </div>
                                        </div>
                                        <div class="d-flex p-2 text-white">
                                            <div>
                                                <i class="fas fa-map-marker-alt text-sm"></i>
                                            </div>
                                            <div class="ps-3">
                                                <span class="text-sm opacity-8">No 6 NASU street , Agbowo Ibadan Oyo
                                                    state </span>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="mailto:reservations@talentsapartments.com" target="_blank"
                                                class="btn btn-icon-only btn-link text-white btn-lg mb-0"
                                                data-toggle="tooltip" data-placement="bottom"
                                                data-original-title="Send Email">
                                                <i class="fas fa-envelope text-lg opacity-8"></i>
                                            </a>
                                            <a href="https://api.whatsapp.com/send/?phone=27647579638&text&type=phone_number&app_absent=0"
                                                target="_blank"
                                                class="btn btn-icon-only btn-link text-white btn-lg mb-0"
                                                data-toggle="tooltip" data-placement="bottom"
                                                data-original-title="Chat on WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            <a href="tel:+234 902 8814 649" target="_blank"
                                                class="btn btn-icon-only btn-link text-white btn-lg mb-0"
                                                data-toggle="tooltip" data-placement="bottom"
                                                data-original-title="Make a Call">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                            <a href=""
                                                class="btn btn-icon-only btn-link text-white btn-lg mb-0"
                                                data-toggle="tooltip" data-placement="bottom"
                                                data-original-title="Make a Call">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                            <a href="tel:+234 902 8814 649" target="_blank"
                                                class="btn btn-icon-only btn-link text-white btn-lg mb-0"
                                                data-toggle="tooltip" data-placement="bottom"
                                                data-original-title="Make a Call">
                                                <i class="fab fa-instagram"></i>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -------- START FOOTER 5 w/ DARK BACKGROUND ------- -->





    <!-- -------   START PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
    <div class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 p-0 m-0">
                    <!-- Google Map Copied Code -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15824.972736703918!2d3.9046381662067264!3d7.438322241370014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1039edc3399f5dc5%3A0xf56b66a9d0fec498!2sTalents%20Hostel!5e0!3m2!1sen!2sng!4v1661817591665!5m2!1sen!2sng"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-sm-6 p-0 m-0">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15825.062317267633!2d3.8910049!3d7.4358376!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x90fe28750fbabc0b!2zN8KwMjYnMDkuNiJOIDPCsDUzJzM2LjkiRQ!5e0!3m2!1sen!2sng!4v1662918735349!5m2!1sen!2sng"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- -------   END PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->





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
                                <a class="nav-link text-white pe-1"
                                    href="https://api.whatsapp.com/send/?phone=27647579638&text&type=phone_number&app_absent=0"
                                    target="_blank">
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
                                <a class="nav-link text-white" href="/#features" target="_blank">
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
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Talents Apartment by <a href="http://alresia.com"
                                target="_blank">Alresia Inc</a>.
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


    <script type="text/javascript">
        if (document.getElementById('state1')) {
            const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
            if (!countUp.error) {
                countUp.start();
            } else {
                console.error(countUp.error);
            }
        }
        if (document.getElementById('state2')) {
            const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
            if (!countUp1.error) {
                countUp1.start();
            } else {
                console.error(countUp1.error);
            }
        }
        if (document.getElementById('state3')) {
            const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
            if (!countUp2.error) {
                countUp2.start();
            } else {
                console.error(countUp2.error);
            };
        }
        if (document.getElementById('state4')) {
            const countUp2 = new CountUp('state4', document.getElementById("state4").getAttribute("countTo"));
            if (!countUp2.error) {
                countUp2.start();
            } else {
                console.error(countUp2.error);
            };
        }
    </script>
    {{-- 
<script type="text/javascript">

    var map;

    $(document).ready(function () {

        new GMaps({
  div: '#map',
  lat: -12.043333,
  lng: -77.028333
});

    });

</script> --}}





























</body>

</html>
