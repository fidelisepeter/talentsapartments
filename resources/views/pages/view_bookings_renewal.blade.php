@extends('layouts.main')
@section('page-title', 'Bookings Renewal')
@if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
    {{-- Stay --}}
@else
    {{ Session::flash('error', 'You are not permited to view that page') }}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@section('content')

    @php
        $new_rent = DB::table('rents')
            ->where('type', 'renewal')
            ->where('previous_rent', $rent->id)
            ->first();
        
        $new_rent_payment = $new_rent
            ? DB::table('invoices')
                ->where('application_no', $new_rent->payment_reference)
                ->first()
            : '';
        $new_room = DB::table('rooms')
            ->where('id', $new_rent->requested_room)
            ->first();
        $is_new_room_available = DB::table('bed_spaces')
            ->where('room_id', $new_room->id)
            ->whereNull('user_id')
            ->where('allocated', false)
            ->first()
            ? true
            : false;
        $is_new_bedspace_available =
            DB::table('bed_spaces')
                ->where('id', $new_rent->requested_bedspace)
                ->where('room_id', $new_room->id)
                ->whereNull('user_id')
                ->where('allocated', false)
                ->first() || $new_rent->requested_bedspace == $rent->bed_space
                ? true
                : false;
        
    @endphp

    <div class="card">
        <div class="card-body p-3 pb-7">
            <div class="row">
                <div class="m-auto col-sm-12 col-lg-8">
                    <div class="row">
                        <div class="col-sm-5 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <h6 class="text-center">Previous/Current Room</h6>
                                    <div class="text-center">
                                        <a href="/booking_view/{{ $rent->id }}" class="" data-toggle="tooltip"
                                            data-original-title="View Current Booking Details">
                                            <h3 class=" font-weight-bolder text-primary">
                                                {{ DB::table('rooms')->where('id', $rent->room_id)->value('name') }}
                                            </h3>
                                            <span class="text-center text primary">
                                                ₦{{ DB::table('rooms')->where('id', $rent->room_id)->value('price') }}
                                            </span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 mb-xl-0 mb-4 d-flex align-items-center">
                            <div class="text-center m-auto">
                                <i class="m-auto fas fa-exchange-alt fixed-plugin-button-nav cursor-pointer"
                                    style="font-size: 40px;" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-sm-5 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <h6 class="text-center">Requested Room</h6>
                                    <div class="text-center">
                                        <a href="/booking_view/{{ $new_rent->id }}" class="" data-toggle="tooltip"
                                            data-original-title="View New Booking Details">
                                            <h3 class=" font-weight-bolder text-primary">
                                                {{ $new_room->name }}
                                            </h3>
                                            <span class="text-center text primary">
                                                ₦{{ $new_room->price }}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @if (
                (isset($new_rent_payment->payment_status) && $new_rent_payment->payment_status == 'paid') ||
                    (isset($new_rent_payment->status) && $new_rent_payment->status == 'paid'))
                {{-- Cant Edit has payment info --}}
                <form action="javascript:;">
                    @csrf
                @else
                    <form action="/bookings/{{ $rent->id }}/approve_renewal" method="post">
                        @csrf
            @endif


            <div class="text-center mt-3">
                <h4 class="">Renewal Details</h4>
                <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                        <strong class="text-dark">Checkout date:</strong> <span
                            class="">{{ \Carbon\Carbon::parse($rent->expiring_date)->format('j M, Y') }}
                            @if ($rent->expiring_date > \Carbon\Carbon::now())
                                ({{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($rent->expiring_date)) }}
                                days
                                left)
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                        <strong class="text-dark">Price Difference:</strong> <span>


                            @if (
                                $new_room->price >
                                    DB::table('rooms')->where('id', $rent->room_id)->value('price'))
                                ₦{{ number_format($new_room->price -DB::table('rooms')->where('id', $rent->room_id)->value('price')) }}
                                <i class="fas fa-arrow-up text-success"></i>
                            @else
                                ₦{{ number_format(DB::table('rooms')->where('id', $rent->room_id)->value('price') - $new_room->price) }}
                                <i class="fas fa-arrow-down text-danger"></i>
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                        <strong class="text-dark">Room Availabilty:</strong>
                        @if ($is_new_room_available)
                            <span class="">Available</span>
                        @else
                            <span class="text-danger">Unavailable</span>
                        @endif
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                        <strong class="text-dark">Bed Space Availabilty:</strong>
                        @if ($is_new_bedspace_available)
                            <span class="">Available</span>
                        @else
                            <span class="text-danger">Unavailable</span>
                        @endif

                    </li>

                </ul>
                <div class="mt-3">
                    <span class="text-sm">Room Change Approval</span>

                    <select class="form-control m-auto w-auto" name="room_change_status">
                        <option value="Approved" selected="">Approve
                        </option>
                        <option value="Declined">Decline
                        </option>
                    </select>
                </div>
                <hr>
                <div class="mt-3  m-auto w-auto">
                    <h4 class="">Approve/Decline renewal</h4>

                    <span class="text-sm">You need to approve renewal in other to allow resident proceed to
                        payment</span>
                    <div class="mt-3">
                        @if (
                            (isset($new_rent_payment->payment_status) && $new_rent_payment->payment_status == 'paid') ||
                                (isset($new_rent_payment->status) && $new_rent_payment->status == 'paid'))
                            {{-- Cant Edit has payment info --}}
                            <button class="btn btn-sm bg-gradient-primary my-sm-auto mt-2 mb-0 me-3" type="button"
                                disabled>Approve</button>
                            <a class="btn btn-sm bg-gradient-danger my-sm-auto mt-2 mb-0" href="javascript:;">Decline</a>
                        @else
                            <button class="btn btn-sm bg-gradient-primary my-sm-auto mt-2 mb-0 me-3"
                                type="submit">Approve</button>
                            <a class="btn btn-sm bg-gradient-danger my-sm-auto mt-2 mb-0"
                                href="/bookings/{{ $rent->id }}/decline_renewal">Decline</a>
                        @endif

                    </div>
                    {{-- <textarea class="form-control m-auto w-auto" name="" id="" cols="30" rows="10"></textarea> --}}
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        @media (min-width:1200px) {
            .float-xl-start {
                float: left !important
            }

            .float-xl-end {
                float: right !important
            }

            .float-xl-none {
                float: none !important
            }
        }
    </style>
@endsection
