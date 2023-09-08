@extends('pages.home-page.layout')

@section('page-title', 'Home')
@section('content')
@php
function cal_percentage($num_amount, $num_total) {
  $count1 = $num_amount / $num_total;
  $count2 = $count1 * 100;
  $count = number_format($count2, 0);
  return $count;
}


@endphp
    {{-- ============================ Hero Banner  Start================================== --}}
    {{-- <div class="image-cover hero_banner" style="background:url(./assets/img/home2.jpg) no-repeat;" data-overlay="5">
    <div class="container">

        <h1 class="text-center">Affordable PREMIUM
        </h1>
        <h2 class="big-header-capt text-center mb-0">Student Accomodation</h2>

    </div>
</div> --}}
    {{-- ============================ Hero Banner End ================================== --}}
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
        </ol>
        <div class="carousel-inner">
            {{-- Temporary --}}
            <!--<div class="carousel-item head-carousel active w-100 "-->
            <!--    style="background: url({{ asset('home-page-assets/img/seasons-greetings.jpg') }}); background-size:100% 100%; background-repeat: no-repeat;">-->
            <!--    <div class="container hero_banner">-->
            <!--    </div>-->

            <!--</div>-->
            <!--<div class="carousel-item head-carousel w-100 "-->
            <!--    style="background: url({{ asset('home-page-assets/img/promo-web.png') }}); background-size:100% 100%; background-repeat: no-repeat;">-->
            <!--    <div class="container hero_banner">-->

            <!--    </div>-->
            <!--</div>-->
            {{-- Temporary End --}}
            <div class="carousel-item head-carousel active w-100 "
                style="background:linear-gradient(0deg, #11284861, #1128486b), url({{ asset('home-page-assets/img/home2.jpg') }}); background-size:cover;">
                <div class="container hero_banner">

                    <h1 class="text-center text-white">Affordable PREMIUM Student Accomodation
                    </h1>

                </div>

            </div>
            <div class="carousel-item head-carousel w-100 "
                style="background:linear-gradient(0deg, #11284861, #1128486b), url({{ asset('home-page-assets/img/blackgirlsroomate.jpg') }}); background-size:cover;">
                <div class="container hero_banner">

                    <h1 class="text-center text-white">PREMIUM & SAFE
                    </h1>

                </div>
            </div>
            <div class="carousel-item  head-carousel w-100 "
                style="background:linear-gradient(0deg, #11284861, #1128486b), url({{ asset('home-page-assets/img/guysroomates.jpg') }}); background-size:cover;">
                <div class="container hero_banner">

                    <h1 class="text-center text-white">Decide WHO YOU stay with
                    </h1>

                </div>
            </div>
            <div class="carousel-item head-carousel w-100 "
                style="background:linear-gradient(0deg, #11284861, #1128486b), url({{ asset('home-page-assets/img/girlstudying.jpg') }}); background-size:cover;">
                <div class="container hero_banner">

                    <h1 class="text-center text-white">PREMIUM & SAFE
                    </h1>

                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    {{-- ============================ Property Type Start ================================== --}}
    <section id="features" class="gray-simple min">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="sec-heading center">
                        <h2>Featured Property Types</h2>
                        <p>What You Will Find</p>
                    </div>
                </div>
            </div>

            <div class="row row-fet justify-content-center">

                <div class=" col-xl col-lg col-md-4 col-fet col-sm-6">
                    {{-- Single Category --}}
                    <div class="property_cats_boxs">
                        <a href="grid-layout-with-sidebar.html" class="category-box">
                            <div class="property_category_short">
                                <div class="category-icon clip-1">
                                    <i class="bi bi-tv"></i>
                                </div>

                                <div class="property_category_expand property_category_short-text">
                                    <h4>TV Room</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg col-md-4 col-fet  col-sm-6">
                    {{-- Single Category --}}
                    <div class="property_cats_boxs">
                        <a href="grid-layout-with-sidebar.html" class="category-box">
                            <div class="property_category_short">
                                <div class="category-icon clip-2">
                                    <i class="bi bi-book"></i>
                                </div>

                                <div class="property_category_expand property_category_short-text">
                                    <h4>Study Room</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg col-fet col-md-4">
                    {{-- Single Category --}}
                    <div class="property_cats_boxs">
                        <a href="grid-layout-with-sidebar.html" class="category-box">
                            <div class="property_category_short">
                                <div class="category-icon clip-3">
                                    <i class="flaticon-apartments"></i>
                                </div>

                                <div class="property_category_expand property_category_short-text">
                                    <h4>Laundry</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg col-fet col-md-4">
                    {{-- Single Category --}}
                    <div class="property_cats_boxs">
                        <a href="grid-layout-with-sidebar.html" class="category-box">
                            <div class="property_category_short">
                                <div class="category-icon clip-4">
                                    <i class="bi bi-shield-lock"></i>
                                </div>

                                <div class="property_category_expand property_category_short-text">
                                    <h4>Safe and Secure</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg col-fet col-md-4">
                    {{-- Single Category --}}
                    <div class="property_cats_boxs">
                        <a href="grid-layout-with-sidebar.html" class="category-box">
                            <div class="property_category_short">
                                <div class="category-icon clip-5">
                                    <i class="bi bi-file-ruled"></i>
                                </div>

                                <div class="property_category_expand property_category_short-text">
                                    <h4>Lockable Cupboards</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg col-fet col-md-4">
                    {{-- Single Category --}}
                    <div class="property_cats_boxs">
                        <a href="grid-layout-with-sidebar.html" class="category-box">
                            <div class="property_category_short">
                                <div class="category-icon clip-1">
                                    <i class="bi bi-lightbulb"></i>
                                </div>

                                <div class="property_category_expand property_category_short-text">
                                    <h4>LED Lighting</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg col-fet col-md-4">
                    {{-- Single Category --}}
                    <div class="property_cats_boxs">
                        <a href="grid-layout-with-sidebar.html" class="category-box">
                            <div class="property_category_short">
                                <div class="category-icon clip-3">
                                    <i class="bi bi-geo-alt"></i>
                                </div>

                                <div class="property_category_expand property_category_short-text">
                                    <h4>Prime Location</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg col-fet col-md-4">
                    {{-- Single Category --}}
                    <div class="property_cats_boxs">
                        <a href="grid-layout-with-sidebar.html" class="category-box">
                            <div class="property_category_short">
                                <div class="category-icon clip-4">
                                    <i class="bi bi-battery-charging"></i>
                                </div>

                                <div class="property_category_expand property_category_short-text">
                                    <h4>Backup Power</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg col-fet col-md-4">
                    {{-- Single Category --}}
                    <div class="property_cats_boxs">
                        <a href="grid-layout-with-sidebar.html" class="category-box">
                            <div class="property_category_short">
                                <div class="category-icon clip-5">
                                    <i class="bi bi-people"></i>
                                </div>

                                <div class="property_category_expand property_category_short-text">
                                    <h4>Roommate Matching</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg col-fet col-md-4">
                    {{-- Single Category --}}
                    <div class="property_cats_boxs">
                        <a href="grid-layout-with-sidebar.html" class="category-box">
                            <div class="property_category_short">
                                <div class="category-icon clip-2">
                                    <i class="bi bi-smartwatch"></i>
                                </div>

                                <div class="property_category_expand property_category_short-text">
                                    <h4>Professional On-Site Management</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- ============================ Property Type End ================================== --}}

    {{-- ============================ Recent Property Start ================================== --}}

    <section class="min" id="room">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="sec-heading center">
                        <h2>Our Rooms</h2>
                        <p>Talents Apartments offers premium, safe student accommodation with a unique hospitality approach
                            to service, for total peace of mind. </p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    @foreach (DB::table('rooms')->get() as $room_type)
                        @if ($room_type->show_in_site)
                            <div class="col-lg-6 col-md-12">
                                <div class="property-listing property-2 row">

                                    <div class="listing-img-wrapper col-lg-5 image-cover"
                                        style="background:url({{ $room_type->photo }}) no-repeat;">

                                    </div>

                                    <div class="listing-detail-wrapper col">
                                        <div class="listing-short-detail-wrap">
                                            <div class="_card_list_flex mb-2">
                                                <div class="_card_flex_01">
                                                    <h2 class="listing-name verified"><a href=""
                                                            class="prt-link-detail">
                                                           
                                                            {{ $room_type->name }}

                                                            @if ($room_type->status != 'available')
                                                                <span class="text-danger text-xxs" style="font-size: 12px;">Unavailable</span>
                                                            @endif
                                                        </a></h2>
                                                </div>
                                                <div class="_card_flex_last">
                                                    <span class="property-type elt_rent">₦{{ number_format($room_type->price) }}</span>
                                                </div>
                                            </div>
                                            <div class="listing-short-detail">

                                                {{-- <div class="foot-location"><img src="./assets/img/pin.svg" width="18"
                                                        alt="" /><strong> CAMPUS:</strong> Situated 5 minutes from
                                                    the University gate
                                                </div> --}}
                                                <div class="foot-location"><img src="./assets/img/pin.svg" width="18"
                                                        alt="" />
                                                        @php
                                                                
                                                        $location = explode(':', DB::table('locations')->where('id', $room_type->location)->value('name'));
                                                    @endphp
                                                        <strong> {{ $location[0] ?? '' }}:</strong>
                                                    {{ $location[1] ?? '' }}
                                                </div>
                                                <div class="sec-heading">
                                                    <p>{{ $room_type->detail }}</p>
                                                </div>
                                            </div>
                                            <div class="listing-detail-footer">
                                                <div class="footer-flex">

                                                    <div class="foot-location"><a href="product-page"><span
                                                                class="pric_lio theme-bg">More Details</span></a></div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row my-5 justify-content-center foot-location">
                    <a href="/product-page"><span class=" pric_lio theme-bg">View All</span></a>
                </div>

            </div>

        </div>
    </section>
    {{-- ============================ Property End ================================== --}}

    {{-- ============================ Our Counter Start ================================== --}}
    <section class="image-cover" style="background:#122947 url(./assets/img/pattern.png) no-repeat;">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-10 col-md-12 col-sm-12">
                    <div class="text-center mb-5">
                        <span class="theme-cl">Our Locations</span>
                        <h2 class="font-weight-normal text-light">Our two locations are conveniently located inside and
                            outside of the University of Ibadan depending on your needs.</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="_morder_counter">
                        <div class="_morder_counter_thumb"><i class="ti-cup"></i></div>
                        <div class="_morder_counter_caption">
                            <h5 class="text-light"><span id="bedspace" countto="{{ App\Models\BedSpace::count() }}">{{ App\Models\BedSpace::count() }}</span></h5>
                            <span>Total Bedspace</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="_morder_counter">
                        <div class="_morder_counter_thumb"><i class="ti-briefcase"></i></div>
                        <div class="_morder_counter_caption">
                            <h5 class="text-light"><span id="locations" countto="{{ DB::table('locations')->count() }}">{{ DB::table('locations')->count() }}</span> </h5>
                            <span>Locations</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="_morder_counter">
                        <div class="_morder_counter_thumb"><i class="ti-light-bulb"></i></div>
                        <div class="_morder_counter_caption">
                            @php
                                $total_bedspace = App\Models\BedSpace::count();
                                $allocated = App\Models\BedSpace::whereNotNull('user_id')->where('allocated', true)->count();
                                $allocated_per = cal_percentage($allocated, $total_bedspace);
                            @endphp
                            <h5 class="text-light"><span id="allocated_per" countto="{{ $allocated_per }}">{{ $allocated_per }}</span> %</h5>
                            <span>Occupancy </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="_morder_counter">
                        <div class="_morder_counter_thumb"><i class="ti-heart"></i></div>
                        <div class="_morder_counter_caption">
                            <h5 class="text-light"><span id="customer-satisfaction" countto="96">96</span> </h5>
                            <span>Customer Satisfaction</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    {{-- ============================ Our Counter End ================================== --}}

    {{-- =========================Testimonials ===================== --}}


    <section class="gray-simple">
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                {{-- Carousel indicators --}}
                {{-- <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol> --}}
                {{-- Wrapper for carousel items --}}
                <div class="d-flex col carousel-inner px-5">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="media">
                                    <img src="/examples/images/clients/1.jpg" class="mr-3" alt="">
                                    <div class="media-body">
                                        <div class="testimonial">
                                            <p>Lorem ipsum dolor sit amet, consec adipiscing elit. Nam eusem scelerisque
                                                tempor, varius quam luctus dui. Mauris magna metus nec.</p>
                                            <p class="overview"><b>Paula Wilson</b>, Media Analyst</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="media">
                                    <img src="/examples/images/clients/2.jpg" class="mr-3" alt="">
                                    <div class="media-body">
                                        <div class="testimonial">
                                            <p>Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget mi
                                                suscipit tincidunt. Utmtc tempus dictum. Pellentesque virra.</p>
                                            <p class="overview"><b>Antonio Moreno</b>, Web Developer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="media">
                                    <img src="/examples/images/clients/3.jpg" class="mr-3" alt="">
                                    <div class="media-body">
                                        <div class="testimonial">
                                            <p>Lorem ipsum dolor sit amet, consec adipiscing elit. Nam eusem scelerisque
                                                tempor, varius quam luctus dui. Mauris magna metus nec.</p>
                                            <p class="overview"><b>Michael Holz</b>, Seo Analyst</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="media">
                                    <img src="/examples/images/clients/4.jpg" class="mr-3" alt="">
                                    <div class="media-body">
                                        <div class="testimonial">
                                            <p>Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget mi
                                                suscipit tincidunt. Utmtc tempus dictum. Pellentesque virra.</p>
                                            <p class="overview"><b>Mary Saveley</b>, Web Designer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="media">
                                    <img src="/examples/images/clients/5.jpg" class="mr-3" alt="">
                                    <div class="media-body">
                                        <div class="testimonial">
                                            <p>Lorem ipsum dolor sit amet, consec adipiscing elit. Nam eusem scelerisque
                                                tempor, varius quam luctus dui. Mauris magna metus nec.</p>
                                            <p class="overview"><b>Martin Sommer</b>, UX Analyst</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="media">
                                    <img src="/examples/images/clients/6.jpg" class="mr-3" alt="">
                                    <div class="media-body">
                                        <div class="testimonial">
                                            <p>Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget mi
                                                suscipit tincidunt. Utmtc tempus dictum. Pellentesque virra.</p>
                                            <p class="overview"><b>John Williams</b>, Web Developer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Carousel controls --}}
                <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>
    </section>
    {{-- {{-- =============================Testimonial End ================ -> --}}


@endsection


@section('style')
    <style>
        .head-carousel .carousel-item {
            height: 85vh;
            min-height: 350px;
            background: no-repeat center center scroll;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }


        .carousel .carousel-item {
            color: #999;
            overflow: hidden;
            min-height: 120px;
            font-size: 13px;
        }

        .carousel .media img {
            width: 80px;
            height: 80px;
            display: block;
            border-radius: 50%;
        }

        .carousel .testimonial {
            padding: 0 15px 0 60px;
            position: relative;
        }

        .carousel .testimonial::before {
            content: "\201C";
            font-family: Arial, sans-serif;
            color: #e2e2e2;
            font-weight: bold;
            font-size: 68px;
            line-height: 54px;
            position: absolute;
            left: 15px;
            top: 0;
        }

        .carousel .overview b {
            text-transform: uppercase;
            color: #1c47e3;
        }

        .carousel .carousel-indicators {
            bottom: -40px;
        }

        .carousel-indicators li,
        .carousel-indicators li.active {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin: 1px 3px;
            box-sizing: border-box;
        }

        .carousel-indicators li {
            background: #e2e2e2;
            border: 4px solid #fff;
        }

        .carousel-indicators li.active {
            color: #fff;
            background: #1c47e3;
            border: 5px double;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
            margin-top: -20px;
            top: 50%;
            background: none;
        }

        .carousel-control-prev i,
        .carousel-control-next i {
            font-size: 28px;
            line-height: 32px;
            position: absolute;
            display: inline-block;
            color: rgba(0, 0, 0, 0.8);
            text-shadow: 0 3px 3px #e6e6e6, 0 0 0 #000;
        }
    </style>
@endsection

@section('script')
<!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
<script src="./dashboard-assets/js/plugins/countup.min.js"></script>

<script type="text/javascript">
    if (document.getElementById('allocated_per')) {
        const countUp = new CountUp('allocated_per', document.getElementById("allocated_per").getAttribute("countTo"));
        if (!countUp.error) {
            countUp.start();
        } else {
            console.error(countUp.error);
        }
    }
    if (document.getElementById('locations')) {
        const countUp1 = new CountUp('locations', document.getElementById("locations").getAttribute("countTo"));
        if (!countUp1.error) {
            countUp1.start();
        } else {
            console.error(countUp1.error);
        }
    }
    if (document.getElementById('bedspace')) {
        const countUp2 = new CountUp('bedspace', document.getElementById("bedspace").getAttribute("countTo"));
        if (!countUp2.error) {
            countUp2.start();
        } else {
            console.error(countUp2.error);
        };
    }
    if (document.getElementById('customer-satisfaction')) {
        const countUp2 = new CountUp('customer-satisfaction', document.getElementById("customer-satisfaction").getAttribute("countTo"));
        if (!countUp2.error) {
            countUp2.start();
        } else {
            console.error(countUp2.error);
        };
    }
</script>
@endsection