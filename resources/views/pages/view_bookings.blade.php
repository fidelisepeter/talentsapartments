@extends('layouts.main')
@section('page-title',
    'Booking#' .
    $rent->id .
    '
    ' .
    DB::table('users')->where('id', $user_id)->value('first_name') .
    '
    ' .
    DB::table('users')->where('id', $user_id)->value('middle_name') .
    '
    ' .
    DB::table('users')->where('id', $user_id)->value('last_name'))

    @if (Auth::user()->role == 'student' ||
            Auth::user()->role == 'super_admin' ||
            Auth::user()->role == 'admin' ||
            Auth::user()->role == 'complaints_manager' ||
            Auth::user()->role == 'staff')
        {{-- Stay --}}
    @else
        {{ Session::flash('error', 'You are not permited to view that page') }}
        <script>
            window.location.href = "{{ url('/dashboard') }}";
        </script>
    @endif
@section('content')

    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert  alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-12">

            @if (
                $rent->user_id == Auth::user()->id &&
                    !empty($rent->expiring_date) &&
                    \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($rent->expiring_date)) <= 45)
                <div class="alert alert-info" style="color:white">
                    Your Rent will expire in
                    {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($rent->expiring_date)) }} days! Click <a
                        href="/booking/{{ $rent->id }}/renew">Here</a> to request renewal
                </div>
            @endif
        </div>
        <div class="col-lg-3">
            <div class="position-sticky top-1
            position-sticky top-1">

                <div class="card ">
                    <ul class="nav flex-column bg-white border-radius-lg p-3">
                        <li class="nav-item">
                            <a class="nav-link text-body" data-scroll="" href="#user_details">
                                <div class="icon me-2">
                                    <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 44"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>document</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(154.000000, 300.000000)">
                                                        <path class="color-background"
                                                            d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                            opacity="0.603585379"></path>
                                                        <path class="color-background"
                                                            d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span class="text-sm">Personal Details</span>
                            </a>
                        </li>

                        <li class="nav-item pt-2">
                            <a class="nav-link text-body" data-scroll="" href="#school_info">
                                <div class="icon me-2">
                                    <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 44"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>switches</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1870.000000, -440.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(154.000000, 149.000000)">
                                                        <path class="color-background"
                                                            d="M10,20 L30,20 C35.4545455,20 40,15.4545455 40,10 C40,4.54545455 35.4545455,0 30,0 L10,0 C4.54545455,0 0,4.54545455 0,10 C0,15.4545455 4.54545455,20 10,20 Z M10,3.63636364 C13.4545455,3.63636364 16.3636364,6.54545455 16.3636364,10 C16.3636364,13.4545455 13.4545455,16.3636364 10,16.3636364 C6.54545455,16.3636364 3.63636364,13.4545455 3.63636364,10 C3.63636364,6.54545455 6.54545455,3.63636364 10,3.63636364 Z"
                                                            opacity="0.6"></path>
                                                        <path class="color-background"
                                                            d="M30,23.6363636 L10,23.6363636 C4.54545455,23.6363636 0,28.1818182 0,33.6363636 C0,39.0909091 4.54545455,43.6363636 10,43.6363636 L30,43.6363636 C35.4545455,43.6363636 40,39.0909091 40,33.6363636 C40,28.1818182 35.4545455,23.6363636 30,23.6363636 Z M30,40 C26.5454545,40 23.6363636,37.0909091 23.6363636,33.6363636 C23.6363636,30.1818182 26.5454545,27.2727273 30,27.2727273 C33.4545455,27.2727273 36.3636364,30.1818182 36.3636364,33.6363636 C36.3636364,37.0909091 33.4545455,40 30,40 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span class="text-sm">School Info</span>
                            </a>
                        </li>
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body" data-scroll="" href="#documents">
                                <div class="icon me-2">
                                    <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 42 42"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>box-3d-50</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(603.000000, 0.000000)">
                                                        <path class="color-background"
                                                            d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                                                        </path>
                                                        <path class="color-background"
                                                            d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z"
                                                            opacity="0.7"></path>
                                                        <path class="color-background"
                                                            d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z"
                                                            opacity="0.7"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span class="text-sm">Documents</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="#guarantor_info">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 40" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>spaceship</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(4.000000, 301.000000)">
                                                    <path class="color-background"
                                                        d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z">
                                                    </path>
                                                    <path class="color-background"
                                                        d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z">
                                                    </path>
                                                    <path class="color-background"
                                                        d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"
                                                        opacity="0.598539807"></path>
                                                    <path class="color-background"
                                                        d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"
                                                        opacity="0.598539807"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="text-sm">Guarantor Info</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="#health_check">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 45 40"
                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>shop </title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(0.000000, 148.000000)">
                                                    <path class="color-background"
                                                        d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"
                                                        opacity="0.598981585"></path>
                                                    <path class="color-foreground"
                                                        d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="text-sm">Health Check</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="#attestation">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 45 40"
                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>shop </title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(0.000000, 148.000000)">
                                                    <path class="color-background"
                                                        d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"
                                                        opacity="0.598981585"></path>
                                                    <path class="color-foreground"
                                                        d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="text-sm">Attestation</span>
                        </a>
                    </li> --}}
                    </ul>
                </div>
                @if (Auth::user()->role == 'super_admin')



                    <div class="card mt-4">
                        <div class="card-header pb-0">
                            <h6>Admin Approval</h6>

                        </div>
                        <div class="card-body p-3">
                            <div class="">
                                @if (
                                    $rent->school_check_status == 'Approved' &&
                                        $rent->proof_status == 'Approved' &&
                                        $rent->guarantor_letter_status == 'Approved' &&
                                        $rent->health_check_status == 'Approved' &&
                                        $rent->attestation_letter_status == 'Approved')
                                    @if (DB::table('rents')->where(
                                                'id',
                                                DB::table('users')->whereNotNull('verification_code')->where('verification_code', $rent->room_mate_code)->value('current_rent'))->value('room_mate_code') ==
                                            DB::table('users')->where('id', $rent->user_id)->value('verification_code'))
                                        <div class="alert alert-info alert-dismissible" role="alert"
                                            style="color:white">
                                            {{ DB::table('users')->where('id', $rent->user_id)->value('first_name') }}
                                            {{ DB::table('users')->where('id', $rent->user_id)->value('middle_name') }}
                                            {{ DB::table('users')->where('id', $rent->user_id)->value('last_name') }}
                                            wants to be with
                                            {{ DB::table('users')->whereNotNull('verification_code')->where('verification_code', $rent->room_mate_code)->value('first_name') }}
                                            {{ DB::table('users')->whereNotNull('verification_code')->where('verification_code', $rent->room_mate_code)->value('middle_name') }}
                                            {{ DB::table('users')->whereNotNull('verification_code')->where('verification_code', $rent->room_mate_code)->value('last_name') }}
                                            as room mate.
                                        </div>
                                    @endif
                                    {{-- @if (empty($rent->move_in)) --}}
                                    <form action="/change_room_type" method="post" style="">
                                        @csrf
                                        <input type="hidden" name="rent_id" value="{{ $rent->id }}">

                                        Room Type: <select class="form-control" data-room_id="" name="room_type"
                                            id="change-room-type" disabled>
                                            <option value="" disabled>-Select-</option>
                                            @foreach (DB::table('rooms')->get() as $room_type)
                                                <option @if ($room_type->id == $rent->room_id) selected @endif
                                                    value="{{ $room_type->id }}">
                                                    {{ $room_type->name }} @if ($room_type->id == $rent->room_id)
                                                        (current)
                                                    @endif
                                                </option>
                                            @endforeach

                                        </select>
                                    </form>

                                    <form action="/approve_rent" method="post" style="">
                                        <div class="mb-3">

                                            <div class="">

                                                <div class="">
                                                    {{-- <h6 class="text-dark text-sm font-weight-bold mb-2">Final Admit
                                                        Students</h6> --}}

                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $rent->id }}">


                                                    Select Room: <select class="form-control"
                                                        data-room_id="{{ $rent->room_id }}" name="room_numbers"
                                                        id="room_numbers" required>
                                                        <option value="" disabled>-Select-</option>
                                                        @foreach (\App\Models\BedSpace::where('room_id', $rent->room_id)->where('user_id', $rent->user_id)->orwhere('room_id', $rent->room_id)->whereNull('user_id')->where('allocated', false)->get()->unique('room_number') as $roomList)
                                                            <option @if (
                                                                $roomList->room_number ==
                                                                    \App\Models\BedSpace::where('id', $rent->bed_space)->value('room_number') /* && $rent->status != 'Archived' */) selected @endif
                                                                value="{{ $roomList->room_number }}">
                                                                {{ $roomList->room_number }}</option>
                                                        @endforeach

                                                    </select>
                                                    <input type="hidden" name="user_id" value="{{ $rent->user_id }}">

                                                    Bed No: <a id="loadBedSpace" href="#"
                                                        class="text-sm text-primary">Refresh </a>
                                                    <select class="form-control" name="bed_space" id="bed_name"
                                                        required>
                                                        <option value="" disabled>-Select Bed-</option>
                                                        @foreach (\App\Models\BedSpace::where('room_id', \App\Models\BedSpace::where('id', $rent->bed_space)->value('room_id'))->where('room_number', \App\Models\BedSpace::where('id', $rent->bed_space)->value('room_number'))->where('user_id', $rent->user_id)->orWhere('room_id', \App\Models\BedSpace::where('id', $rent->bed_space)->value('room_id'))->where('room_number', \App\Models\BedSpace::where('id', $rent->bed_space)->value('room_number'))->whereNull('user_id')->where('allocated', false)->get() as $view)
                                                            <option @if ($view->id == $rent->bed_space /** && $rent->status != 'Archived' */) selected @endif
                                                                value="{{ $view->id }}">{{ $view->name }}</option>
                                                        @endforeach




                                                    </select>


                                                    Move In: <input class="form-control" type="date" name="move_in"
                                                        id="move_in"
                                                        value="{{ $rent->move_in ? \Carbon\Carbon::parse($rent->move_in)->format('Y-m-d') : '' }}"
                                                        required>
                                                    Move Out: <input class="form-control" type="date" name="move_out"
                                                        id="move_out"
                                                        value="{{ $rent->expiring_date ? \Carbon\Carbon::parse($rent->expiring_date)->format('Y-m-d') : '' }}"
                                                        required>
                                                    <br><br>
                                                    {{-- <input class="btn btn-block btn-primary" type="submit" value="Room"> --}}
                                                    <button class="btn btn-block btn-primary w-100" type="submit">
                                                        @if ($rent->status == 'Archived')
                                                            Re-assign
                                                        @else
                                                            Approve Student
                                                        @endif
                                                    </button>

                                                    @if ($rent->status == 'Archived')
                                                        <h6 class="text-danger text-sm font-weight-bold mb-2"> Rent has
                                                            been archived re assign a bed space to this resident using the
                                                            above form</h6>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>

                                        </div>
                                    </form>
                                    {{-- @endif --}}

                                    <div class="mb-3">

                                        <div class="">
                                            <h6 class="text-dark text-sm font-weight-bold mb-2"></h6>


                                            {{-- <br>
                                    <a class="btn btn-success" href="/approve/{{ $rent->id }}">Approve</a> --}}
                                            <a class="btn btn-danger w-100" href="/reject/{{ $rent->id }}">Reject
                                                Student</a>
                                            {{-- <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p> --}}
                                        </div>
                                    </div>
                                    <div class="mb-3">

                                        <div class="">





                                            @if ($rent->status == 'Approved')
                                                <a class="btn btn-warning w-100"
                                                    href="/archive/{{ $rent->id }}">Archive Rent</a>
                                            @endif

                                        </div>
                                    </div>
                                @else
                                    <div class="text-center text-danger h4">
                                        Approve Student Payment First
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                @endif
                @if (
                    \App\Models\BedSpace::where(
                        'id',
                        DB::table('rents')->where('id', Auth::user()->current_rent)->value('bed_space'))->first() &&
                        DB::table('rents')->where('id', Auth::user()->current_rent)->value('status') == 'Approved')
                    <div class="card mt-4">
                        <div class="card-header pb-0">
                            <h6>Congratulation! You have been Approved</h6>

                        </div>
                        <div class="card-body p-3">

                        </div>
                    </div>
                    <div class="card mt-3 bg-gradient-primary">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8 my-auto">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold opacity-7"
                                            style="color:white">
                                            Room Details</p>
                                        <p class=" font-weight-bolder mb-0" style="color:white">

                                            {{ \App\Models\BedSpace::where('id',DB::table('rents')->where('id', Auth::user()->current_rent)->value('bed_space'))->value('room_number') }}
                                            -
                                            {{ \App\Models\BedSpace::where('id',DB::table('rents')->where('id', Auth::user()->current_rent)->value('bed_space'))->value('name') }}

                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    {{-- <img class="w-50" src="../../assets/img/small-logos/icon-sun-cloud.png"
                                    alt="image sun"> --}}
                                    {{-- <h5 class="mb-0 text-white text-end me-1">Cloudy</h5> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>


        </div>
        <div class="col-lg-9 mt-lg-0 mt-4">

            {{-- <div class="card position-sticky top-1 z-index-2 card-body" id="user_details">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-sm-auto col-4">
                            @if ($rent->school_check_status == 'Approved')
                            <button class="btn bg-gradient-success mb-0 ms-2" type="submit" name="submit">Step 1</button>
                                       @else
                                       <button class="btn bg-gradient-warning mb-0 ms-2" type="submit" name="submit">Step 1</button>
                                       @endif
                        </div>
                        <div class="col-sm-auto col-4">
                            @if ($rent->proof_status == 'Approved')
                            <button class="btn bg-gradient-success mb-0 ms-2" type="submit" name="submit">Step 2</button>
                                       @else
                                       <button class="btn bg-gradient-warning mb-0 ms-2" type="submit" name="submit">Step 2</button>
                                       @endif
                        </div>
                        <div class="col-sm-auto col-4">
                            @if ($rent->proof_status == 'Approved')
                            <button class="btn bg-gradient-success mb-0 ms-2" type="submit" name="submit">Step 3</button>
                                       @else
                                       <button class="btn bg-gradient-warning mb-0 ms-2" type="submit" name="submit">Step 3</button>
                                       @endif
                        </div>
                    </div>
                </div> --}}

            <div class="card" id="basic-info">
                <div class="card-header">
                    <h5>Basic Info</h5>
                </div>
                <div class="card-body pt-0">

                    {{-- <h4>Personal Info</h4> --}}
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                Name:</strong> &nbsp;
                            {{ DB::table('users')->where('id', $user_id)->value('first_name') }}
                            {{ DB::table('users')->where('id', $user_id)->value('middle_name') }}
                            {{ DB::table('users')->where('id', $user_id)->value('last_name') }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong>
                            &nbsp; {{ DB::table('users')->where('id', $user_id)->value('phone_number') }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                            &nbsp; {{ DB::table('users')->where('id', $user_id)->value('email') }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong>
                            &nbsp; State:
                            {{ DB::table('users')->where('id', $user_id)->value('state') }} | City:
                            {{ DB::table('users')->where('id', $user_id)->value('city') }} |
                            Street:{{ DB::table('users')->where('id', $user_id)->value('street') }}</li>

                    </ul>
                </div>
            </div>


            <div class="card mt-4" id="school_info">
                <div class="card-header  mb-0 d-flex">
                    <h5 class="mb-0">School Information</h5>

                </div>

                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-6">
                            {{-- <h4>School Info</h4> --}}

                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                        class="text-dark">School:</strong> &nbsp;
                                    {{ DB::table('users')->where('id', $user_id)->value('school') }}</li>
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Matric
                                        No:</strong> &nbsp;
                                    {{ DB::table('users')->where('id', $user_id)->value('matric_number') }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Department:</strong>
                                    &nbsp;
                                    {{ DB::table('users')->where('id', $user_id)->value('department') }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Course:</strong>
                                    &nbsp; {{ DB::table('users')->where('id', $user_id)->value('course') }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Level:</strong>
                                    &nbsp; {{ DB::table('users')->where('id', $user_id)->value('level') }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Admission
                                        Lettre:</strong>
                                    &nbsp; <a
                                        href="{{ DB::table('users')->where('id', $user_id)->value('admission_letter') }}"
                                        target="_blank" class="text-primary">View File</a>

                                </li>

                            </ul>
                        </div>
                        <div class="col-sm-6 mt-3">
                            @if (Auth::user()->role != 'student')
                                <div class="d-sm-flex bg-gray-100 border-radius-lg p-2">
                                    <p class="text-sm font-weight-bold my-auto ps-sm-2 mb-0">Status</p>
                                    <h6 class="text-sm ms-auto me-3 my-auto"></h6>
                                    @if ($rent->school_check_status == 'Approved')
                                        <span
                                            class="badge badge-sm bg-gradient-success">{{ $rent->school_check_status }}</span>
                                    @else
                                        <span
                                            class="badge badge-sm bg-gradient-warning">{{ $rent->school_check_status }}</span>
                                    @endif
                                </div>
                                <form action="/booking_status" method="post" class="mt-2" style="font-size:10px">
                                    @csrf
                                    <input type="text" name="step" id="" value="school" hidden>
                                    <input type="text" name="rent_id" id="" value="{{ $id }}"
                                        hidden>
                                    <input type="text" name="user_id" id="" value="{{ $user_id }}"
                                        hidden>
                                    <select @if ($rent->school_check_status == 'Approved' && Auth::user()->role != 'super_admin') disabled @endif
                                        onchange="//this.form.submit()" class="form-control" name="status">
                                        <option value="Pending" @if ($rent->school_check_status == 'Pending') selected @endif>Pending
                                        </option>
                                        <option value="Approved" @if ($rent->school_check_status == 'Approved') selected @endif>Approve
                                        </option>
                                        <option value="Declined" @if ($rent->school_check_status == 'Declined') selected @endif>Decline
                                        </option>
                                    </select>
                                    <input type="submit" class="btn btn-sm bg-gradient-primary mb-0 mt-2" value="submit"
                                        @if ($rent->school_check_status == 'Approved' && Auth::user()->role != 'super_admin') disabled @endif>
                                </form>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4" id="documents">
                <div class="card-header">
                    <h5>DOCUMENTS</h5>
                </div>



                <div class="card-body pt-0">
                    @if (Auth::user()->role == 'student')
                        <strong class="text-danger">
                            INTRUCTIONS
                        </strong>

                        <ul>
                            <li class="text-danger">
                                Please Kindly Scan your Documents and Upload in PDF
                            </li>
                            <li class="text-danger">
                                Please upload all documents
                            </li>
                        </ul>
                    @endif

                    <div class="row">
                        <div class="text-center">
                            <div class="h-divider  text-center m-3">
                                <div class="shadow"></div>
                                <div class="text bg-gradient-primary text-center" style="color:aliceblue"><span
                                        class="">STEP 1</span></div>
                            </div>
                        </div>


                        <h5>Proof of Payment</h5>
                        {{-- <p class="text-sm mb-0"><span class="font-weight-bold ms-1"> Bank Name: GTBank</span></p> --}}

                        <div class="col-sm-5 mb-2 text-center p-3" style="width:200px;">



                            @if (DB::table('invoices')->where('application_no', $rent->payment_reference)->value('payment_status') != 'paid')
                                <div class="card h-100 card-plain border">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="">
                                            <h6 class=" text-secondary"> No File submitted </h6>

                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="card h-100 card-plain border">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="/invoice/{{ $rent->payment_reference }}" target="_blank"
                                            rel="noopener noreferrer">

                                            <h6 class=" text-secondary"> Click to view invoice</h6>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if (DB::table('invoices')->where('application_no', $rent->payment_reference)->value('payment_status') == 'paid')
                            <div class="col-sm-4">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Paid
                                            Status:</strong> &nbsp;
                                        {{ DB::table('invoices')->where('application_no', $rent->payment_reference)->value('payment_status') }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Payment
                                            Reference:</strong>
                                        &nbsp;
                                        {{ $rent->payment_reference }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Payment
                                            Method:</strong>
                                        &nbsp;
                                        {{ DB::table('invoices')->where('application_no', $rent->payment_reference)->value('payment_method') }}
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Amount
                                            Paid:</strong>
                                        &nbsp; ₦
                                        {{ number_format(DB::table('invoices')->where('application_no', $rent->payment_reference)->value('amount')) }}
                                    </li>

                                </ul>
                            </div>
                        @endif

                        <div class="@if (DB::table('invoices')->where('application_no', $rent->payment_reference)->value('payment_status') != 'paid') col-sm-7 @else col-sm-3 @endif my-auto">

                            @if (Auth::user()->role == 'student')
                                @if ($rent->school_check_status == 'Approved')
                                    @if ($rent->proof_status != 'Approved')

                                        @if (DB::table('invoices')->where('application_no', $rent->payment_reference)->value('payment_status') != 'paid')
                                            <div class="@if ($rent->payment_reference == null) d-none @endif" id="payment_box"
                                                data-application_no="{{ $rent->payment_reference ?? '' }}"
                                                data-transaction_id="{{ strtoupper(substr(str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890'), 0, 12)) }}"
                                                data-phone_number="{{ DB::table('users')->where('id', $user_id)->value('phone_number') }}"
                                                data-full_name="{{ DB::table('users')->where('id', $user_id)->value('first_name') .' ' .DB::table('users')->where('id', $user_id)->value('middle_name') .' ' .DB::table('users')->where('id', $user_id)->value('last_name') }}"
                                                data-amount="{{ $rent->price }}"
                                                data-original-amount="{{ $rent->original_price }}
                                        ">
                                                <h5 class="text-center">Choose a method of payment</h5>
                                                <div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6" {{-- id="pay_via_online" --}}
                                                        onclick="payWithPaystackDeactivated()">
                                                        <div class="d-flex border border-warning rounded">
                                                            <div class="avatar avatar-lg">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/logos/mastercard.png">
                                                            </div>
                                                            <div class="ms-2 my-auto">


                                                                <span class="mb-0" style="color:black">Pay Online</span>
                                                                <p class="text-xs mb-0">Mastercard, Verve, Visa, etc</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" id="pay_via_bankWWWW" data-toggle="modal"
                                                        data-target="#direct_payment_confirm">
                                                        <div class="d-flex border border-dark bg-white rounded">
                                                            <div class="avatar avatar-lg">
                                                                <img alt="Image placeholder"
                                                                    src="../assets/img/small-logos/icon-bulb.svg"
                                                                    height="45">
                                                            </div>
                                                            <div class="ms-2 my-auto">
                                                                <span class="mb-0" style="color:black">Bank
                                                                    Transfer</span>
                                                                <p class="text-xs mb-0">Transfer from your account or bank
                                                                    branch</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex bg-gray-100 border-radius-lg p-3 my-3">

                                                    <div>
                                                        <h6 class="my-auto">

                                                            <span class="text-secondary text-sm me-1">Invoice
                                                                No:</span>{{ $rent->payment_reference }}

                                                        </h6>
                                                        <h4 class="my-auto">
                                                            <span
                                                                class="text-secondary text-sm me-1">₦</span>{{ number_format($rent->price) }}

                                                        </h4>
                                                        <span class="text-secondary text-sm ms-1">Pay using your Debit Card
                                                            (master card, visa, verse, etc..) or Payment via bank
                                                            transfer</span>

                                                    </div>


                                                </div>
                                            </div>
                                            <div class="@if ($rent->payment_reference != null) d-none @endif text-center mb-3"
                                                id="invoice_box">
                                                <h6 class="text-center">You have not created any invoice for this booking
                                                </h6>
                                                <p class="text-center">Click the button below to generate an invoice</p>
                                                <button id="create_invoice"
                                                    class="btn btn-sm bg-gradient-primary mb-0 mt-2" type="button">
                                                    Make Payment
                                                </button>
                                            </div>
                                            {{-- @else
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                class="text-dark">Paid Status:</strong> &nbsp;
                                            {{ DB::table('invoices')->where('application_no', $rent->payment_reference)->value('payment_status') }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Payment Reference:</strong>
                                            &nbsp;
                                            {{ $rent->payment_reference }}
                                        </li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Payment Method:</strong>
                                            &nbsp; {{ DB::table('invoices')->where('application_no', $rent->payment_reference)->value('payment_method') }}
                                        </li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Amount Paid:</strong>
                                            &nbsp; ₦ {{ number_format(DB::table('invoices')->where('application_no', $rent->payment_reference)->value('amount')) }}
                                        </li>
        
                                    </ul> --}}
                                        @endif
                                    @else
                                        <div class="cardcard-plain">
                                            <div
                                                class="border border-success rounded card-body d-flex flex-column justify-content-center text-center text-primary">


                                                <span class="text-success text-gradient"> Your payment has been approved
                                                    <br>
                                                    <i class="ni ni-check-bold text-success text-gradient"></i></span>

                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-danger">You have to be approved first!</p>
                                @endif
                            @else
                                @if ($rent->school_check_status == 'Approved')
                                    <div class="d-sm-flex bg-gray-100 border-radius-lg p-2">
                                        <p class="text-sm font-weight-bold my-auto ps-sm-2 mb-0"
                                            style="text-wrap: nowrap;">Change Status</p>
                                        <h6 class="text-sm ms-auto me-3 my-auto">
                                            {{-- {{ $rent->payment_reference }} --}}
                                        </h6>
                                        @if ($rent->proof_status == 'Approved')
                                            <span
                                                class="badge badge-sm bg-gradient-success">{{ $rent->proof_status }}</span>
                                        @else
                                            <span
                                                class="badge badge-sm bg-gradient-warning">{{ $rent->proof_status ?? 'Pending' }}</span>
                                        @endif
                                    </div>





                                    {{-- <form action="/booking_status" method="post" class="mt-3" style="font-size:10px">
                                        @csrf
                                        <input type="text" name="step" id="" value="payment" hidden>
                                        <input type="text" name="rent_id" id="" value="{{ $id }}"
                                            hidden>
                                        <input type="text" name="user_id" id="" value="{{ $user_id }}"
                                            hidden>
                                        <select class="form-control" name="status" id=""
                                            @if (($rent->proof_status == 'Approved' && Auth::user()->role != 'super_admin') || $rent->payment_reference == null) disabled @endif>
                                            <option value="Pending" @if ($rent->proof_status == 'Pending') selected @endif>
                                                Pending
                                            </option>
                                            <option value="Approved" @if ($rent->proof_status == 'Approved') selected @endif>
                                                Approve
                                            </option>
                                            <option value="Declined" @if ($rent->proof_status == 'Declined') selected @endif>
                                                Decline
                                            </option>
                                        </select>
                                        <input class="btn btn-sm bg-gradient-primary mb-0 mt-2" type="submit"
                                            value="submit" @if (($rent->proof_status == 'Approved' && Auth::user()->role != 'super_admin') || $rent->payment_reference == null) disabled @endif>
                                    </form> --}}
                                    <select class="form-control mt-3 document-status documents-status"
                                        data-name="proof_status" id=""
                                        @if (($rent->proof_status == 'Approved' && Auth::user()->role != 'super_admin') || $rent->payment_reference == null) disabled @endif>
                                        <option value="Pending" @if ($rent->proof_status == 'Pending') selected @endif>
                                            Pending
                                        </option>
                                        <option value="Approved" @if ($rent->proof_status == 'Approved') selected @endif>
                                            Approve
                                        </option>
                                        <option value="Declined" @if ($rent->proof_status == 'Declined') selected @endif>
                                            Decline
                                        </option>
                                    </select>
                                @else
                                    <p class="text-danger">Approve Student First!</p>
                                @endif
                            @endif

                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <div class="h-divider mt-3 mb-3">
                            <div class="shadow"></div>
                            <div class="text bg-gradient-primary text-center" style="color:aliceblue"><span
                                    class="">STEP 2</span></div>
                        </div>
                    </div>


                    <hr />
                    <div class="row my-3">
                        <div class="d-flex">
                            <h5 class="mb-0">Profile Picture</h5>


                        </div>
                        @if (Auth::user()->role == 'student')
                            <p>Upload picture of you</p>
                            {{-- <p>picture can only be uploaded once </p> --}}
                        @else
                            <p>Profile picture/passport</p>
                        @endif

                        <div class="col-sm-5 mb-2 text-center p-3" style="width:200px;">
                            @if (DB::table('users')->where('id', $user_id)->value('photo') != null)
                                <div class="card h-100 card-plain border"
                                    style="
                                background-image: url('{{ DB::table('users')->where('id', $user_id)->value('photo') }}');
                                background-size: contain; background-repeat: no-repeat; background-position: center;">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="{{ DB::table('users')->where('id', $user_id)->value('photo') }}"
                                            target="_blank" rel="noopener noreferrer">

                                            {{-- <h6 class=" text-secondary"> Click to view PDF File</h6> --}}
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="card h-100 card-plain border"
                                    style="
                                background-image: url('{{ asset('assets/img/no-pics-placeholder.jpg') }}');
                                background-size: contain; background-repeat: no-repeat; background-position: center;">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="">
                                            <h6 class=" text-secondary"> No picture submitted </h6>

                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="col-sm-7 my-auto">
                            @if (Auth::user()->role == 'student')
                                @if ($rent->proof_status == 'Approved')
                                    {{-- @if (DB::table('users')->where('id', $user_id)->value('photo') == null) --}}
                                    <form class="" action="/booking_step" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="step" id="" value="picture" hidden>
                                        <input type="text" name="rent_id" id="" value="{{ $id }}"
                                            hidden>
                                        <input type="text" name="user_id" id="" value="{{ $user_id }}"
                                            hidden>
                                        <input type="file" required class="form-control" name="file"
                                            id="">
                                        <button class="btn btn-info my-3" type="submit">Upload</button>
                                    </form>
                                    {{-- @else
                                        <div class="cardcard-plain">
                                            <div
                                                class="border border-success rounded card-body d-flex flex-column justify-content-center text-center text-primary">


                                                <span class="text-success text-gradient"> Your document has been approved
                                                    <i class="ni ni-check-bold text-success text-gradient"></i></span>

                                            </div>
                                        </div>
                                    @endif --}}
                                @else
                                    <p class="text-danger">Your payment have to be approved first!</p>
                                @endif
                            @else
                                <div class="d-sm-flex bg-gray-100 border-radius-lg p-2">
                                    <p class="text-sm font-weight-bold my-auto ps-sm-2 mb-0">Status</p>
                                    <h6 class="text-sm ms-auto me-3 my-auto"></h6>
                                    @if (DB::table('users')->where('id', $user_id)->value('photo') != null)
                                        <span class="badge badge-sm bg-gradient-success">Uploaded</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                    @endif
                                </div>
                                {{-- @if ($rent->school_check_status == 'Approved')
                                    <div class="d-sm-flex bg-gray-100 border-radius-lg p-2">
                                        <p class="text-sm font-weight-bold my-auto ps-sm-2 mb-0">Status</p>
                                        <h6 class="text-sm ms-auto me-3 my-auto"></h6>
                                        @if ($rent->attestation_letter_status == 'Approved')
                                            <span
                                                class="badge badge-sm bg-gradient-success">{{ $rent->attestation_letter_status }}</span>
                                        @else
                                            <span
                                                class="badge badge-sm bg-gradient-warning">{{ $rent->attestation_letter_status ?? 'Pending' }}</span>
                                        @endif
                                    </div>


                                    <form action="/booking_status" method="post" class="mt-3" style="font-size:10px">
                                        @csrf
                                        <input type="text" name="step" id="" value="attestation" hidden>
                                        <input type="text" name="rent_id" id="" value="{{ $id }}"
                                            hidden>
                                        <input type="text" name="user_id" id="" value="{{ $user_id }}"
                                            hidden>
                                        <select class="form-control" name="status" id=""
                                            @if (($rent->attestation_letter_status == 'Approved' && Auth::user()->role != 'super_admin') || $rent->attestation_letter_photo == null) disabled @endif>
                                            <option value="Pending" @if ($rent->attestation_letter_status == 'Pending') selected @endif>
                                                Pending
                                            </option>
                                            <option value="Approved" @if ($rent->attestation_letter_status == 'Approved') selected @endif>
                                                Approve
                                            </option>
                                            <option value="Declined" @if ($rent->attestation_letter_status == 'Declined') selected @endif>
                                                Decline
                                            </option>
                                        </select>
                                        <input class="btn btn-sm bg-gradient-primary mb-0 mt-2" type="submit"
                                            value="submit" @if (($rent->attestation_letter_status == 'Approved' && Auth::user()->role != 'super_admin') || $rent->attestation_letter_photo == null) disabled @endif>
                                    </form>
                                @else
                                    <p class="text-danger">Approve Student Payments First!</p>
                                @endif --}}
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row my-3">



                        <div class="d-flex">
                            <h5 class="mb-0">Guarantor information</h5>


                            @if (DB::table('settings')->value('guarantor_form_file'))
                                <a class="text-primary text-bold mb-0 ms-2 ms-auto"
                                    href="{{ asset(DB::table('settings')->value('guarantor_form_file')) }}"
                                    target="_blank">
                                    <i class="fa fa-arrow-down top-0" aria-hidden="true"></i> Download Guarantor Form Here
                                </a>
                            @else
                                <span class="text-primary text-bold mb-0 ms-2 ms-auto"> File Not Available for now</span>
                            @endif
                        </div>
                        <p>Download the Guarantor form, fill and upload as PDF</p>


                        <div class="col-sm-5 mb-2 text-center p-3" style="width:200px;">
                            @if ($rent->guarantor_letter_photo != null)
                                <div class="card h-100 card-plain border">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="{{ $rent->guarantor_letter_photo }}" target="_blank"
                                            rel="noopener noreferrer">

                                            <h6 class=" text-secondary"> Click to view PDF File</h6>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="card h-100 card-plain border">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="">
                                            <h6 class=" text-secondary"> No File submitted </h6>

                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        {{-- @if ($rent->guarantor_letter_photo != null)
                            <div class="col-sm-4" style="width:200px;">
                                <img width="100%" height="100%" src="{{ $rent->guarantor_letter_photo }}"
                                    alt="" srcset="">
                            </div>
                        @endif --}}
                        <div class="col-sm-4">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                        Name:</strong> &nbsp;
                                    {{ DB::table('users')->where('id', $user_id)->value('g_suffix') }}
                                    {{ DB::table('users')->where('id', $user_id)->value('g_first_name') }}
                                    {{ DB::table('users')->where('id', $user_id)->value('g_last_name') }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Relationship:</strong>
                                    &nbsp;
                                    {{ DB::table('users')->where('id', $user_id)->value('g_relationship') }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Mobile:</strong>
                                    &nbsp;
                                    {{ DB::table('users')->where('id', $user_id)->value('g_phone_number') }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Email:</strong>
                                    &nbsp; {{ DB::table('users')->where('id', $user_id)->value('g_email') }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Location:</strong>
                                    &nbsp; State:
                                    {{ DB::table('users')->where('id', $user_id)->value('g_state') }} | City:
                                    {{ DB::table('users')->where('id', $user_id)->value('g_city') }} |
                                    Street:{{ DB::table('users')->where('id', $user_id)->value('g_street') }}
                                </li>
                                @if ($rent->school_check_status == 'Approved')
                                    <li class="list-group-item border-0 ps-0 text-sm">
                                        <i class="ni ni-bell-55 text-success text-gradient"></i>
                                        <span class="text-success text-bold">Guarantor Form Sent <i
                                                class="ni ni-check-bold text-success text-gradient"></i></span>
                                    </li>
                                @endif

                            </ul>
                        </div>
                        <div class="col-sm-4 my-auto">
                            @if (Auth::user()->role != 'student')
                                @if ($rent->school_check_status == 'Approved')
                                    <a href="/send_guarantor_form/{{ $user_id }}"
                                        class="btn btn-sm bg-gradient-primary mb-0 mt-2 mb-2">re-send guarantor form</a>
                                    <div class="d-sm-flex bg-gray-100 border-radius-lg p-2">
                                        <p class="text-sm font-weight-bold my-auto ps-sm-2 mb-0"
                                            style="text-wrap: nowrap;">Change Status</p>
                                        <h6 class="text-sm ms-auto me-3 my-auto"></h6>
                                        @if ($rent->guarantor_letter_status == 'Approved')
                                            <span
                                                class="badge badge-sm bg-gradient-success">{{ $rent->guarantor_letter_status }}</span>
                                        @else
                                            <span
                                                class="badge badge-sm bg-gradient-warning">{{ $rent->guarantor_letter_status ?? 'Pending' }}</span>
                                        @endif
                                    </div>


                                    {{-- <form action="/booking_status" class="mt-3" method="post" style="font-size:10px">
                                        @csrf
                                        <input type="text" name="step" id="" value="guarantor" hidden>
                                        <input type="text" name="rent_id" id="" value="{{ $id }}"
                                            hidden>
                                        <input type="text" name="user_id" id="" value="{{ $user_id }}"
                                            hidden>
                                        <select class="form-control" name="status" id=""
                                            @if (($rent->guarantor_letter_status == 'Approved' && Auth::user()->role != 'super_admin') || $rent->guarantor_letter_photo == null) disabled @endif>
                                            <option value="Pending" @if ($rent->guarantor_letter_status == 'Pending') selected @endif>
                                                Pending
                                            </option>
                                            <option value="Approved" @if ($rent->guarantor_letter_status == 'Approved') selected @endif>
                                                Approve
                                            </option>
                                            <option value="Declined" @if ($rent->guarantor_letter_status == 'Declined') selected @endif>
                                                Decline
                                            </option>
                                        </select>
                                        <input class="btn btn-sm bg-gradient-primary mb-0 mt-2" type="submit"
                                            value="submit" @if (($rent->guarantor_letter_status == 'Approved' && Auth::user()->role != 'super_admin') || $rent->guarantor_letter_photo == null) disabled @endif>
                                    </form> --}}
                                    <select class="form-control mt-3 documents-status" data-name="guarantor_letter_status"
                                        id="" @if (
                                            ($rent->guarantor_letter_status == 'Approved' && Auth::user()->role != 'super_admin') ||
                                                $rent->guarantor_letter_photo == null) disabled @endif>
                                        <option value="Pending" @if ($rent->guarantor_letter_status == 'Pending') selected @endif>
                                            Pending
                                        </option>
                                        <option value="Approved" @if ($rent->guarantor_letter_status == 'Approved') selected @endif>
                                            Approve
                                        </option>
                                        <option value="Declined" @if ($rent->guarantor_letter_status == 'Declined') selected @endif>
                                            Decline
                                        </option>
                                    </select>
                                    {{-- <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p> --}}
                                    {{-- @else
                                    <p class="text-danger">Approve Payment First!</p> --}}
                                @endif
                            @else
                                @if ($rent->proof_status != 'Approved')
                                    <p class="text-danger">Your Payment need to be approved first!</p>
                                @else
                                    <div class="text-info">
                                        The Guarantor form has been sent to your guarantor email
                                        ({{ DB::table('users')->where('id', $user_id)->value('g_email') }})
                                    </div>
                                    <div class="text-dark">
                                        Ask your Gurrantor to fill form, scan in PDF and submit here
                                    </div>
                                    @if ($rent->guarantor_letter_status != 'Approved')
                                        <form class="" action="/booking_step" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" name="step" id="" value="guarantor"
                                                hidden>
                                            <input type="text" name="rent_id" id=""
                                                value="{{ $id }}" hidden>
                                            <input type="text" name="user_id" id=""
                                                value="{{ $user_id }}" hidden>
                                            <input type="file" required class="form-control mb-3" name="file"
                                                id="" @if ($rent->guarantor_letter_status == 'Approved') disabled @endif>
                                            <button class="btn btn-info" type="submit"
                                                @if ($rent->guarantor_letter_status == 'Approved') disabled @endif>Upload form</button>
                                        </form>
                                    @else
                                        <div class="cardcard-plain">
                                            <div
                                                class="border border-success rounded card-body d-flex flex-column justify-content-center text-center text-primary">


                                                <span class="text-success text-gradient"> Your document has been approved
                                                    <i class="ni ni-check-bold text-success text-gradient"></i></span>

                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>



                    <hr />
                    <div class="row my-3">
                        <div class="d-flex">
                            <h5 class="mb-0">Health/Medical Report </h5>


                            @if (DB::table('settings')->value('health_form_file'))
                                <a class="text-primary text-bold mb-0 ms-2 ms-auto"
                                    href="{{ asset(DB::table('settings')->value('health_form_file')) }}" target="_blank">
                                    <i class="fa fa-arrow-down top-0" aria-hidden="true"></i> Download Health/Medical Form
                                    Here
                                </a>
                            @else
                                <span class="text-primary text-bold mb-0 ms-2 ms-auto"> File Not Available for now</span>
                            @endif
                        </div>
                        <p>Download Health/Medical form, fill and upload as PDF</p>



                        <div class="col-sm-5 mb-2 text-center p-3" style="width:200px;">

                            @if ($rent->health_check_photo != null)
                                <div class="card h-100 card-plain border">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="{{ $rent->health_check_photo }}" target="_blank"
                                            rel="noopener noreferrer">

                                            <h6 class=" text-secondary"> Click to view PDF File</h6>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="card h-100 card-plain border">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="">
                                            <h6 class=" text-secondary"> No File submitted </h6>

                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-7 my-auto">
                            @if (Auth::user()->role == 'student')
                                @if ($rent->proof_status == 'Approved')
                                    @if ($rent->health_check_status != 'Approved')
                                        <form class="" action="/booking_step" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" name="step" id="" value="health" hidden>
                                            <input type="text" name="rent_id" id=""
                                                value="{{ $id }}" hidden>
                                            <input type="text" name="user_id" id=""
                                                value="{{ $user_id }}" hidden>
                                            <input type="file" required class="form-control mb-3" name="file"
                                                id="" @if ($rent->health_check_status == 'Approved') disabled @endif>
                                            <button class="btn btn-info" type="submit"
                                                @if ($rent->health_check_status == 'Approved') disabled @endif>Upload</button>
                                        </form>
                                    @else
                                        <div class="cardcard-plain">
                                            <div
                                                class="border border-success rounded card-body d-flex flex-column justify-content-center text-center text-primary">


                                                <span class="text-success text-gradient"> Your document has been approved
                                                    <i class="ni ni-check-bold text-success text-gradient"></i></span>

                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-danger">Your payment need to be approved first!</p>
                                @endif
                            @else
                                @if ($rent->school_check_status == 'Approved')
                                    <div class="d-sm-flex bg-gray-100 border-radius-lg p-2">
                                        <p class="text-sm font-weight-bold my-auto ps-sm-2 mb-0"
                                            style="text-wrap: nowrap;">Change Status</p>
                                        <h6 class="text-sm ms-auto me-3 my-auto"></h6>
                                        @if ($rent->health_check_status == 'Approved')
                                            <span
                                                class="badge badge-sm bg-gradient-success">{{ $rent->health_check_status }}</span>
                                        @else
                                            <span
                                                class="badge badge-sm bg-gradient-warning">{{ $rent->health_check_status ?? 'Pending' }}</span>
                                        @endif
                                    </div>



                                    {{-- <form action="/booking_status" method="post" class="mt-3" style="font-size:10px">
                                        @csrf
                                        <input type="text" name="step" id="" value="health" hidden>
                                        <input type="text" name="rent_id" id="" value="{{ $id }}"
                                            hidden>
                                        <input type="text" name="user_id" id="" value="{{ $user_id }}"
                                            hidden>
                                        <select class="form-control" name="status" id=""
                                            @if (($rent->health_check_status == 'Approved' && Auth::user()->role != 'super_admin') || $rent->health_check_photo == null) disabled @endif>
                                            <option value="Pending" @if ($rent->health_check_status == 'Pending') selected @endif>
                                                Pending
                                            </option>
                                            <option value="Approved" @if ($rent->health_check_status == 'Approved') selected @endif>
                                                Approve
                                            </option>
                                            <option value="Declined" @if ($rent->health_check_status == 'Declined') selected @endif>
                                                Decline
                                            </option>
                                        </select>
                                        <input class="btn btn-sm bg-gradient-primary mb-0 mt-2" type="submit"
                                            value="submit" @if (($rent->health_check_status == 'Approved' && Auth::user()->role != 'super_admin') || $rent->health_check_photo == null) disabled @endif>
                                    </form> --}}
                                    <select class="form-control mt-3 documents-status" data-name="health_check_status"
                                        id="" @if (
                                            ($rent->health_check_status == 'Approved' && Auth::user()->role != 'super_admin') ||
                                                $rent->health_check_photo == null) disabled @endif>
                                        <option value="Pending" @if ($rent->health_check_status == 'Pending') selected @endif>
                                            Pending
                                        </option>
                                        <option value="Approved" @if ($rent->health_check_status == 'Approved') selected @endif>
                                            Approve
                                        </option>
                                        <option value="Declined" @if ($rent->health_check_status == 'Declined') selected @endif>
                                            Decline
                                        </option>
                                    </select>
                                @else
                                    <p class="text-danger">Approve Student Payment First!</p>
                                @endif
                            @endif

                        </div>
                    </div>




                    <hr />
                    <div class="row my-3">
                        <div class="d-flex">
                            <h5 class="mb-0">Letter of Attestation</h5>


                            @if (DB::table('settings')->value('attestation_form_file'))
                                <a class="text-primary text-bold mb-0 ms-2 ms-auto"
                                    href="{{ asset(DB::table('settings')->value('attestation_form_file')) }}"
                                    target="_blank">
                                    <i class="fa fa-arrow-down top-0" aria-hidden="true"></i> Download Attestation Form
                                    Here
                                </a>
                            @else
                                <span class="text-primary text-bold mb-0 ms-2 ms-auto"> File Not Available for now</span>
                            @endif
                        </div>
                        <p>Download the Attestation form, fill and upload as PDF</p>

                        <div class="col-sm-5 mb-2 text-center p-3" style="width:200px;">
                            @if ($rent->attestation_letter_photo != null)
                                <div class="card h-100 card-plain border">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="{{ $rent->attestation_letter_photo }}" target="_blank"
                                            rel="noopener noreferrer">

                                            <h6 class=" text-secondary"> Click to view PDF File</h6>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="card h-100 card-plain border">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="">
                                            <h6 class=" text-secondary"> No File submitted </h6>

                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="col-sm-7 my-auto">
                            @if (Auth::user()->role == 'student')
                                @if ($rent->proof_status == 'Approved')
                                    @if ($rent->attestation_letter_status != 'Approved')
                                        <form class="" action="/booking_step" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" name="step" id="" value="attestation"
                                                hidden>
                                            <input type="text" name="rent_id" id=""
                                                value="{{ $id }}" hidden>
                                            <input type="text" name="user_id" id=""
                                                value="{{ $user_id }}" hidden>
                                            <input type="file" required class="form-control" name="file"
                                                id="" @if ($rent->attestation_letter_status == 'Approved') disabled @endif>
                                            <button class="btn btn-info my-3" type="submit"
                                                @if ($rent->attestation_letter_status == 'Approved') disabled @endif>Upload</button>
                                        </form>
                                    @else
                                        <div class="cardcard-plain">
                                            <div
                                                class="border border-success rounded card-body d-flex flex-column justify-content-center text-center text-primary">


                                                <span class="text-success text-gradient"> Your document has been approved
                                                    <i class="ni ni-check-bold text-success text-gradient"></i></span>

                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-danger">Your payment have to be approved first!</p>
                                @endif
                            @else
                                @if ($rent->school_check_status == 'Approved')
                                    <div class="d-sm-flex bg-gray-100 border-radius-lg p-2">
                                        <p class="text-sm font-weight-bold my-auto ps-sm-2 mb-0"
                                            style="text-wrap: nowrap;">Change Status</p>
                                        <h6 class="text-sm ms-auto me-3 my-auto"></h6>
                                        @if ($rent->attestation_letter_status == 'Approved')
                                            <span
                                                class="badge badge-sm bg-gradient-success">{{ $rent->attestation_letter_status }}</span>
                                        @else
                                            <span
                                                class="badge badge-sm bg-gradient-warning">{{ $rent->attestation_letter_status ?? 'Pending' }}</span>
                                        @endif
                                    </div>


                                    {{-- <form action="/booking_status" method="post" class="mt-3" style="font-size:10px">
                                        @csrf
                                        <input type="text" name="step" id="" value="attestation" hidden>
                                        <input type="text" name="rent_id" id="" value="{{ $id }}"
                                            hidden>
                                        <input type="text" name="user_id" id="" value="{{ $user_id }}"
                                            hidden>
                                        <select class="form-control" name="status" id=""
                                            @if (($rent->attestation_letter_status == 'Approved' && Auth::user()->role != 'super_admin') || $rent->attestation_letter_photo == null) disabled @endif>
                                            <option value="Pending" @if ($rent->attestation_letter_status == 'Pending') selected @endif>
                                                Pending
                                            </option>
                                            <option value="Approved" @if ($rent->attestation_letter_status == 'Approved') selected @endif>
                                                Approve
                                            </option>
                                            <option value="Declined" @if ($rent->attestation_letter_status == 'Declined') selected @endif>
                                                Decline
                                            </option>
                                        </select>
                                        <input class="btn btn-sm bg-gradient-primary mb-0 mt-2" type="submit"
                                            value="submit" @if (($rent->attestation_letter_status == 'Approved' && Auth::user()->role != 'super_admin') || $rent->attestation_letter_photo == null) disabled @endif>
                                    </form> --}}
                                    <select class="form-control mt-3 documents-status"
                                        data-name="attestation_letter_status" id=""
                                        @if (
                                            ($rent->attestation_letter_status == 'Approved' && Auth::user()->role != 'super_admin') ||
                                                $rent->attestation_letter_photo == null) disabled @endif>
                                        <option value="Pending" @if ($rent->attestation_letter_status == 'Pending') selected @endif>
                                            Pending
                                        </option>
                                        <option value="Approved" @if ($rent->attestation_letter_status == 'Approved') selected @endif>
                                            Approve
                                        </option>
                                        <option value="Declined" @if ($rent->attestation_letter_status == 'Declined') selected @endif>
                                            Decline
                                        </option>
                                    </select>
                                @else
                                    <p class="text-danger">Approve Student Payments First!</p>
                                @endif
                            @endif
                        </div>
                    </div>


                    {{-- USER CONSUENT DOCUMENTS PART NEW --}}
                    <hr />
                    <div class="row my-3">
                        <div class="d-flex">
                            <h5 class="mb-0">Document Acceptance</h5>


                            {{-- @if (DB::table('settings')->value('attestation_form_file'))
                            <a class="text-primary text-bold mb-0 ms-2 ms-auto"
                                href="{{asset(DB::table('settings')->value('attestation_form_file'))}}" target="_blank">
                                <i class="fa fa-arrow-down top-0" aria-hidden="true"></i> Download Attestation Form Here
                        </a>
                        @else
                        <span class="text-primary text-bold mb-0 ms-2 ms-auto"> File Not Available for now</span>
                        @endif --}}
                        </div>
                        @if (Auth::user()->role == 'student')
                            <p>The Following Document Required you to read and accept the condition written on each
                                respective section of the document</p>
                            <p>You name and other required field will be filled automatically</p>
                        @else
                            <p>Here are list documents for user consent</p>
                        @endif



                        @foreach (\App\Models\Documents::where('type', 'agreement_form')->get() as $agreement_form)
                            <hr class="horizontal dark">
                            <div class="d-flex">
                                <img style="width: 48px; height: 48px;" class="width-48-px"
                                    src="{{ asset('document-files/document-icon.jpeg') }}" alt="logo_spotify">
                                <div class="my-auto ms-3">
                                    <div class="h-100">
                                        <h5 class="mb-0">{{ $agreement_form->title }}</h5>
                                        <a href="/document/print/{{ $agreement_form->id }}/user/{{ $user_id }}"
                                            class="mb-0 text-sm text-primary">view document</a>
                                    </div>
                                </div>

                                <p class="text-sm text-secondary ms-auto me-3 my-auto">
                                    @if ($agreement_form->consent()->where('user_id', $user_id)->first() != null)
                                        Accepted
                                    @else
                                        Awaiting Acceptance
                                    @endif
                                </p>
                                <div class="form-check form-switch my-auto">
                                    <form action="/add_consent/{{ $user_id }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="document_id" id="consent_document_id"
                                            value="{{ $agreement_form->id }}" />
                                        <input type="hidden" name="action"
                                            value="@if ($agreement_form->consent()->where('user_id', $user_id)->first() != null) disable @else enable @endif" />

                                        <input class="form-check-input"
                                            @if ($agreement_form->consent()->where('user_id', $user_id)->first() != null) checked="" @endif type="checkbox"
                                            onchange="this.form.submit()" />
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        <form class="mt-3" action="/update-document-status" method="POST">
                            @csrf
                            <div class="alert alert-warning message-container d-none" style="color: white;"></div>
                            <textarea class="form-control d-none" name="message" id="message-form" placeholder="message to user"></textarea>
                            <input type="hidden" id="payment" name="proof_status"
                                value="{{ $rent->proof_status }}">
                            <input type="hidden" id="guarantor" name="guarantor_letter_status"
                                value="{{ $rent->guarantor_letter_status }}">
                            <input type="hidden" id="health" name="health_check_status"
                                value="{{ $rent->health_check_status }}">
                            <input type="hidden" id="attestation" name="attestation_letter_status"
                                value="{{ $rent->attestation_letter_status }}">

                            <input type="text" name="rent_id" id="" value="{{ $id }}" hidden>
                            <input type="text" name="user_id" id="" value="{{ $user_id }}" hidden>
                            <button type="submit" id="update-documents-status" disabled
                                class="btn bg-gradient-dark mt-3  mb-0 bt">
                                Update Documents Status
                            </button>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
    <!-- Direct Payment Model -->
    {{-- <div class="modal fade" id="direct_payment_confirm" tabindex="-1" role="dialog"
        aria-labelledby="direct_payment_confirm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Your Payment</h5>
                    <button type="button" class="btn-close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <p class=" text-sm mb-0 font-weight-bolder">To confirm your payment please input Transaction ID Given
                        to you by our Sales Mananger</p>
                    <form role="form" id="buyForm" action="/confirm_payment">
                        @csrf
                        <div class="">
                            <label>Transaction ID</label>
                            <input class="form-control" type="hidden" value="bank_transfer" name="type">
                            <input class="form-control" type="hidden" value="" name="application_no">

                            <input class="form-control" type="text" placeholder="eg. TRNS56UK6QGG"
                                onfocus="focused(this)" onfocusout="defocused(this)" name="reference">
                        </div>
                        <div class="button-row d-flex mt-4">
                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                title="Next">Confrim Transaction</button>
                        </div>

                    </form>

                </div>
            </div>
        </div> --}}

    <!-- Direct Payment Model -->
    <div class="modal fade" id="direct_payment_confirm" tabindex="-1" role="dialog"
        aria-labelledby="direct_payment_confirm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Your Payment</h5>
                    <button type="button" class="btn-close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <p class=" text-sm mb-0 font-weight-bolder">To confirm your payment please fill the form and submit</p>

                    <form role="form" id="buyForm" action="/send_payment_info" method="POST">
                        @csrf
                        {{-- <input class="form-control" type="hidden" value="bank_transfer" name="type"> --}}
                        <input class="form-control" type="hidden" value="{{ $rent->payment_reference ?? '' }}"
                            name="application_no">
                        {{-- <input class="form-control" type="hidden" value="{{ $rent->original_price ?? '' }}" name="original_amount"> --}}

                        <div class="">
                            <label>Bank Transaction ID</label>

                            <input class="form-control" type="text" name="bank_transaction_id">

                            <label>Sender Name</label>
                            <input class="form-control" type="text" name="sender_name">

                            <label>Bank Name</label>
                            <input class="form-control" type="text" name="bank_name">

                        </div>
                        <div class="button-row d-flex mt-4">
                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                title="Next">Send Details</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Payment scripts -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="../assets/js/booking-payment-process.js"></script>
    {{-- <script src="../assets/js/plugins/sweetalert.min.js"></script> --}}
    <script>
        function payWithPaystackDeactivated() {
            const requiredButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-gradient-success',
                    cancelButton: 'btn bg-gradient-danger',
                    closeButton: 'btn bg-gradient-primary'
                },
                buttonsStyling: false,
            })
            requiredButtons.fire({
                title: 'Something went wrong!',
                text: 'Sorry this option is not available right now',
                icon: 'error',
                showCloseButton: true,
            })
        }



        $(document).ready(function() {

            // $("#update_consent").on('change', function() {
            //     var document_id = $(this).data('document');
            //     var status = $(this).data('status');
            //     $('#consent_document_id').val(document_id);
            //     $('#consent_status').val(status);
            //     // alert($(this).val())
            //     this.form.submit()

            // });
            // function addYears() {
            //     var date1 = new Date();
            //     var currYear = date1.getFullYear();
            //     var currMonth = date1.getMonth();
            //     var currDay = date1.getDate();
            //     var currHours = date1.getHours();
            //     var currMinutes = date1.getMinutes();
            //     var currSeconds = date1.getSeconds();
            //     var userYears = document.getElementById("userVal").value;
            //     var newDate = new Date(currYear + Number(userYears), currMonth, currDay, currHours, currMinutes,
            //         currSeconds);
            //     document.getElementById("results").textContent = newDate;
            // }

            function loadBedSpace() {
                // alert($("#room_numbers").val());

                // var room_number = "{{ \App\Models\BedSpace::where('room_id', $rent->room_id)->where('user_id', $rent->user_id)->orwhere('room_id', $rent->room_id)->whereNull('user_id')->where('allocated', false)->first()->value('room_number') }}";
                var room_number = $("#room_numbers").val();
                var room_id = "{{ $rent->room_id }}";
                var user_id = "{{ $rent->user_id }}";

                $.ajax({
                    url: "/get_room_details",
                    method: "GET",
                    data: {
                        room_id: room_id,
                        user_id: user_id,
                        room_number: room_number,
                    },
                    dataType: 'JSON',
                    beforeSend(xhr) {},
                    complete(xhr) {},
                    success: function(data) {

                        if (data.status == 'success') {
                            //alert(JSON.stringify(data))

                            $("#bed_name").html(data.bedspace);




                        }
                    },
                    error: function(xhr) {}
                });

            }
            loadBedSpace();
            $("#loadBedSpace").on('click', function() {
                loadBedSpace();
            });

            $(document).on('change', '.documents-status', function() {
                $("#update-documents-status").prop('disabled', false)
            });

            $("#update-documents-status").on('click', function(e) {
                e.preventDefault();
                var ShowMessage = false;
                $(".documents-status").each(function() {
                    var name = $(this).data('name');
                    var value = $(this).val();
                    $('input[name="' + name + '"]').val(value);
                    if (value == 'Pending' || value == 'Declined') {
                        ShowMessage = true;
                    }
                });


                if (ShowMessage && $('#message-form').attr('data-clicked') != 'true') {
                    var message =
                        'One or more field has not been approved send user a message in respect on why it was not approved (leave empty to ignore message)';
                    $('.message-container').removeClass('d-none').text(message);
                    $('#message-form').removeClass('d-none').prop('disabled', false).attr('data-clicked',
                        true)
                } else {
                    $('.message-container').addClass('d-none').text();
                    $('#message-form').addClass('d-none').prop('disabled', false).attr('data-clicked',
                        false)
                    this.form.submit();
                }

            });

            $("#room_numbers").on('change', function() {
                var room_number = $(this).val();
                var room_id = $(this).data('room_id');
                var user_id = "{{ $rent->user_id }}";

                $.ajax({
                    url: "/get_room_details",
                    method: "GET",
                    data: {
                        room_id: room_id,
                        user_id: user_id,
                        room_number: room_number,
                    },
                    dataType: 'JSON',
                    beforeSend(xhr) {},
                    complete(xhr) {},
                    success: function(data) {

                        if (data.status == 'success') {
                            //alert(JSON.stringify(data))

                            $("#bed_name").html(data.bedspace);




                        }
                    },
                    error: function(xhr) {}
                });

            });

            $("#move_in").on('change', function() {
                const move_in = new Date($(this).val());
                move_in.setDate(move_in.getDate() + 365);

                move_out = new Date(move_in);

                var value = move_out.getFullYear() + '-' + (move_out.getMonth() + 1).toString().padStart(2,
                        0) +
                    '-' + move_out.getDate().toString().padStart(2, 0);

                // alert(value);
                $("#move_out").val(value);
                // var move_in = new Date($(this).val());
                // var moveInYear = move_in.getFullYear();
                // var moveInMonth = move_in.getMonth();
                // var moveInDay = move_in.getDate();
                // var moveInHours = move_in.getHours();
                // var moveInMinutes = move_in.getMinutes();
                // var moveInSeconds = move_in.getSeconds();
                // var add = 1;
                // var moveOut = new Date(moveInYear + Number(add), moveInMonth, moveInDay, moveInHours,
                //     moveInMinutes, moveInSeconds);
                // var value = moveInYear + Number(add) + '-' + (moveInMonth+1).toString().padStart(2, 0) +
                //     '-' + moveInDay.toString().padStart(2, 0);
                //     alert(moveOut);
                //     alert(moveOut.getMonth());
                // $("#move_out").val(value);


            });

            $("#change-room-type").on('change', function() {

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn bg-gradient-success',
                        cancelButton: 'btn bg-gradient-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "This room price might be different from the original room price",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //   Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        //   )
                        this.form.submit()
                        // $(this).form.submit();
                    }
                })


            });


            $("#create_invoice").on('click', function() {

                var rent_id = "{{ $rent->id }}";
                var user_id = "{{ $rent->user_id }}";
                var _token = "{{ csrf_token() }}";

                $.ajax({
                    url: "/create_invoice",
                    method: "POST",
                    dataType: 'JSON',
                    data: {
                        rent_id: rent_id,
                        type: 'Rent Booking',
                        user_id: user_id,
                        _token: _token,
                    },
                    beforeSend(xhr) {},
                    complete(xhr) {},
                    success: function(data) {

                        if (data.status === 'success') {
                            Swal.fire(
                                'Success!',
                                data.message,
                                'success'
                            );
                            $('#payment_box').removeClass('d-none');
                            $('#invoice_box').addClass('d-none');
                            $('#payment_box').attr('data-application_no', data.application_no);

                        } else {
                            Swal.fire(
                                'Error!',
                                data.message,
                                'error'
                            );
                        }

                    },

                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'An Internal Error Occured',
                            'error'
                        );
                    }
                });

            });

        });
    </script>
@endsection
