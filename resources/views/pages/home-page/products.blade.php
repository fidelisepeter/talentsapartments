@extends('pages.home-page.layout')

@section('page-title', 'Rooms')
@section('content')

    <!-- ============================ Page Title Start================================== -->
    <div class="page-title" style="background:#f4f4f4 url({{ asset('home-page-assets/img/home2.jpg') }});" data-overlay="5">
        <div class="ht-80"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="_page_tetio">

                        <h1 class="text-light mb-0">Our Rooms</h1>
                        <p class="px-5">Talents Apartments offers premium, safe student accommodation with a unique
                            hospitality approach to service, for total peace of mind.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ht-120"></div>
    </div>
    <!-- ============================ Page Title End ================================== -->

    <!-- ============================ Recent Property Start ================================== -->

    <section class="min">

        <div class="container">
            <div class="row justify-content-center ">
                @foreach (DB::table('rooms')->get() as $room_type)
                    @if ($room_type->show_in_site)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="property-listing property-2">

                                <div class="listing-img-wrapper">
                                    <div class="list-img-slide">
                                        <a href="single-property-1.html"><img src="{{ $room_type->photo }}"
                                                class="img-fluid mx-auto" alt="{{ $room_type->name }}" /></a>
                                    </div>
                                </div>

                                <div class="listing-detail-wrapper">
                                    <div class="listing-short-detail-wrap">
                                        <div class="_card_list_flex mb-2">
                                            <div class="_card_flex_01">
                                                <h2 class="listing-name verified"><a href=""
                                                        class="prt-link-detail">{{ $room_type->name }}</a></h2>
                                            </div>
                                            <div class="_card_flex_last">
                                                <span class="property-type elt_rent">₦{{ number_format($room_type->price) }}</span>
                                            </div>
                                        </div>
                                        <div class="listing-short-detail">
                                            <div class="foot-location"><img src="./assets/img/pin.svg" width="18"
                                                    alt="" />
                                                @php
                                                    
                                                    $location = explode(
                                                        ':',
                                                        DB::table('locations')
                                                            ->where('id', $room_type->location)
                                                            ->value('name'),
                                                    );
                                                @endphp
                                                <strong> {{ $location[0] ?? ''}}:</strong>
                                                {{ $location[1] ?? ''}}
                                            </div>
                                            <div class="sec-heading">
                                                <p>No squatters ﻿(Terms & Conditions apply)<br>
                                                    Curtains, Bedsheets, Pillows not INCLUDED</p>
                                            </div>
                                            @if (!empty($room_type->amenity1))
                                                <div class="d-flex justify-content-lg-start gap-3 align-items-center py-2">
                                                    <div
                                                        class="d-flex justify-content-center icon-xs align-items-center rounded border">
                                                        <i class="bi bi-check"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <span
                                                            class=" text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity1)->value('name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($room_type->amenity2))
                                                <div class="d-flex justify-content-lg-start gap-3 align-items-center py-2">
                                                    <div
                                                        class="d-flex justify-content-center icon-xs align-items-center rounded border">
                                                        <i class="bi bi-check"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <span
                                                            class=" text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity2)->value('name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($room_type->amenity3))
                                                <div class="d-flex justify-content-lg-start gap-3 align-items-center py-2">
                                                    <div
                                                        class="d-flex justify-content-center icon-xs align-items-center rounded border">
                                                        <i class="bi bi-check"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <span
                                                            class=" text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity3)->value('name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($room_type->amenity4))
                                                <div class="d-flex justify-content-lg-start gap-3 align-items-center py-2">
                                                    <div
                                                        class="d-flex justify-content-center icon-xs align-items-center rounded border">
                                                        <i class="bi bi-check"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <span
                                                            class=" text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity4)->value('name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($room_type->amenity5))
                                                <div class="d-flex justify-content-lg-start gap-3 align-items-center py-2">
                                                    <div
                                                        class="d-flex justify-content-center icon-xs align-items-center rounded border">
                                                        <i class="bi bi-check"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <span
                                                            class=" text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity5)->value('name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($room_type->amenity6))
                                                <div class="d-flex justify-content-lg-start gap-3 align-items-center py-2">
                                                    <div
                                                        class="d-flex justify-content-center icon-xs align-items-center rounded border">
                                                        <i class="bi bi-check"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <span
                                                            class=" text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity6)->value('name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($room_type->amenity7))
                                                <div class="d-flex justify-content-lg-start gap-3 align-items-center py-2">
                                                    <div
                                                        class="d-flex justify-content-center icon-xs align-items-center rounded border">
                                                        <i class="bi bi-check"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <span
                                                            class=" text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity7)->value('name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($room_type->amenity8))
                                                <div class="d-flex justify-content-lg-start gap-3 align-items-center py-2">
                                                    <div
                                                        class="d-flex justify-content-center icon-xs align-items-center rounded border">
                                                        <i class="bi bi-check"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <span
                                                            class=" text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity8)->value('name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($room_type->amenity9))
                                                <div class="d-flex justify-content-lg-start gap-3 align-items-center py-2">
                                                    <div
                                                        class="d-flex justify-content-center icon-xs align-items-center rounded border">
                                                        <i class="bi bi-check"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <span
                                                            class=" text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity9)->value('name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!empty($room_type->amenity10))
                                                <div class="d-flex justify-content-lg-start gap-3 align-items-center py-2">
                                                    <div
                                                        class="d-flex justify-content-center icon-xs align-items-center rounded border">
                                                        <i class="bi bi-check"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <span
                                                            class=" text-xs">{{ DB::table('amenities')->where('id', $room_type->amenity10)->value('name') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="listing-detail-footer">
                                    <div class="footer-first">
                                        <span>Apartment</span>
                                    </div>
                                    <div class="footer-flex">

                                        <div class="foot-location"><a href="/register"><span class="pric_lio theme-bg">Book
                                                    Now</span></a></div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @endif
                @endforeach
            </div>


        </div>
    </section>
@endsection


@section('style')
    <style>
        .icon-xs {
            top: -4px;
            font-size: 1em;
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .icon-shape {
            background-position: center;

        }

        .shadow {
            box-shadow: 0 0.3125rem 0.625rem 0 rgb(0 0 0 / 12%) !important;
        }

        .footer-first {
            padding: 10px;
        }
    </style>
@endsection
