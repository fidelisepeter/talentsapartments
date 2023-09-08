@extends('pages.home-page.layout')

@section('page-title', 'Locations')
@section('content')
    

<!-- ============================ Page Title Start================================== -->
<div class="page-title" style="background:#f4f4f4 url({{ asset('home-page-assets/img/home2.jpg') }});" data-overlay="5">
    <div class="ht-80"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="_page_tetio">

                    <h1 class="text-light mb-0">Our Locations</h1>
                    <p class="px-5"> </p>
                </div>
            </div>
        </div>
    </div>
    <div class="ht-120"></div>
</div>
<!-- ============================ Page Title End ================================== -->

<section id="features" class="gray-simple min">
    <div class="container">
        <div class="container border rounded mb-3 p-3">
            <div class=" p-2 ">
                <h2>
                    Insisde Campus by Awolowo hall
                </h2>
            </div>
            <div class="listing-img-wrapper ht-600 image-cover" style="background:url({{ asset('home-page-assets/img/location-one.jpeg') }}) no-repeat;">

            </div>
        </div>
        <div class="container border rounded mb-3 p-3">
            <div class="col p-2 align-items-center">
                <h2>
                    Outside Campus: No 6 Nasu street. Agbowo. Ibadan.
                </h2>
                <p> Few minutes from University gate.</p>
            </div>
            <div class="listing-img-wrapper ht-600 col image-cover" style="background:url({{ asset('home-page-assets/img/location-two.jpeg') }}) no-repeat;">

            </div>
        </div>

    </div>
</section>

@endsection


@section('style')
    
@endsection