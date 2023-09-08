@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('page-title', 'Profile Settings')
@section('content')

    <div class="row mb-5">
        <div class="col-lg-3">
            <div class="card position-sticky top-1">
                <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item">
                        <a class="nav-link text-body" data-scroll="" href="#profile">
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
                            <span class="text-sm">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="#basic-info">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 44" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                            <span class="text-sm">Basic Info</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="#password">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 42 42" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                            <span class="text-sm">Change Password</span>
                        </a>
                    </li>

                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="#accounts">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 42 44"
                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>time-alarm</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-2319.000000, -440.000000)" fill="#923DFA"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(603.000000, 149.000000)">
                                                    <path class="color-background"
                                                        d="M18.8086957,4.70034783 C15.3814926,0.343541521 9.0713063,-0.410050841 4.7145,3.01715217 C0.357693695,6.44435519 -0.395898667,12.7545415 3.03130435,17.1113478 C5.53738466,10.3360568 11.6337901,5.54042955 18.8086957,4.70034783 L18.8086957,4.70034783 Z"
                                                        opacity="0.6"></path>
                                                    <path class="color-background"
                                                        d="M38.9686957,17.1113478 C42.3958987,12.7545415 41.6423063,6.44435519 37.2855,3.01715217 C32.9286937,-0.410050841 26.6185074,0.343541521 23.1913043,4.70034783 C30.3662099,5.54042955 36.4626153,10.3360568 38.9686957,17.1113478 Z"
                                                        opacity="0.6"></path>
                                                    <path class="color-background"
                                                        d="M34.3815652,34.7668696 C40.2057958,27.7073059 39.5440671,17.3375603 32.869743,11.0755718 C26.1954189,4.81358341 15.8045811,4.81358341 9.13025701,11.0755718 C2.45593289,17.3375603 1.79420418,27.7073059 7.61843478,34.7668696 L3.9753913,40.0506522 C3.58549114,40.5871271 3.51710058,41.2928217 3.79673036,41.8941824 C4.07636014,42.4955431 4.66004722,42.8980248 5.32153275,42.9456105 C5.98301828,42.9931963 6.61830436,42.6784048 6.98113043,42.1232609 L10.2744783,37.3434783 C16.5555112,42.3298213 25.4444888,42.3298213 31.7255217,37.3434783 L35.0188696,42.1196087 C35.6014207,42.9211577 36.7169135,43.1118605 37.53266,42.5493622 C38.3484064,41.9868639 38.5667083,40.8764423 38.0246087,40.047 L34.3815652,34.7668696 Z M30.1304348,25.5652174 L21,25.5652174 C20.49574,25.5652174 20.0869565,25.1564339 20.0869565,24.6521739 L20.0869565,15.5217391 C20.0869565,15.0174791 20.49574,14.6086957 21,14.6086957 C21.50426,14.6086957 21.9130435,15.0174791 21.9130435,15.5217391 L21.9130435,23.7391304 L30.1304348,23.7391304 C30.6346948,23.7391304 31.0434783,24.1479139 31.0434783,24.6521739 C31.0434783,25.1564339 30.6346948,25.5652174 30.1304348,25.5652174 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="text-sm">Accounts</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="#notifications">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 44 43"
                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>megaphone</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-2168.000000, -591.000000)" fill="#FFFFFF"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(452.000000, 300.000000)">
                                                    <path class="color-background"
                                                        d="M35.7958333,0.273166667 C35.2558424,-0.0603712374 34.5817509,-0.0908856664 34.0138333,0.1925 L19.734,7.33333333 L9.16666667,7.33333333 C4.10405646,7.33333333 0,11.4373898 0,16.5 C0,21.5626102 4.10405646,25.6666667 9.16666667,25.6666667 L19.734,25.6666667 L34.0138333,32.8166667 C34.5837412,33.1014624 35.2606401,33.0699651 35.8016385,32.7334768 C36.3426368,32.3969885 36.6701539,31.8037627 36.6666942,31.1666667 L36.6666942,1.83333333 C36.6666942,1.19744715 36.3370375,0.607006911 35.7958333,0.273166667 Z">
                                                    </path>
                                                    <path class="color-background"
                                                        d="M38.5,11 L38.5,22 C41.5375661,22 44,19.5375661 44,16.5 C44,13.4624339 41.5375661,11 38.5,11 Z"
                                                        opacity="0.601050967"></path>
                                                    <path class="color-background"
                                                        d="M18.5936667,29.3333333 L10.6571667,29.3333333 L14.9361667,39.864 C15.7423448,41.6604248 17.8234451,42.4993948 19.6501416,41.764381 C21.4768381,41.0293672 22.3968823,38.982817 21.7341667,37.1286667 L18.5936667,29.3333333 Z"
                                                        opacity="0.601050967"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="text-sm">Notifications</span>
                        </a>
                    </li> --}}
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="#sessions">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 40"
                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>settings</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(304.000000, 151.000000)">
                                                    <polygon class="color-background" opacity="0.596981957"
                                                        points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                                    </polygon>
                                                    <path class="color-background"
                                                        d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"
                                                        opacity="0.596981957"></path>
                                                    <path class="color-background"
                                                        d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="text-sm">Sessions</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-4">
            <!-- Card Profile -->
            <div class="card card-body" id="profile">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-auto col-4">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ Auth::user()->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                                alt="bruce" class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-sm-auto col-8 my-auto">
                        <div class="h-100">
                            <h5 class="mb-1 font-weight-bolder">
                                {{ Auth::user()->first_name ?? '' }}
                                {{ Auth::user()->middle_name ?? '' }}
                                {{ Auth::user()->last_name ?? '' }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ Auth::user()->role ?? '' }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                        {{-- <label class="form-check-label mb-0">
                            <small id="profileVisibility">
                                Switch to invisible
                            </small>
                        </label>
                        <div class="form-check form-switch ms-2">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked
                                onchange="visible()">
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- Card Basic Info -->
            <form action="/profile/update-settings" method="POST" enctype="multipart/form-data" id="profile-form">
                {{-- <form action="/profile/update-settings/" method="POST" enctype="multipart/form-data"> --}}
                @csrf
                <div class="card mt-4" id="basic-info">
                    <div class="card-header">
                        <h5>Basic Info</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <div class="input-group">
                                    <input id="first_name" name="first_name" class="form-control" type="text"
                                        value="{{ Auth::user()->first_name ?? '' }}" required="required">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <div class="input-group">
                                    <input id="last_name" name="last_name" class="form-control" type="text"
                                        value="{{ Auth::user()->last_name ?? '' }}" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-5 col-5">
                                        <label class="form-label mt-4">Address</label>
                                        <div class="input-group">
                                            <input id="address" name="address" class="form-control" type="text"
                                                value="{{ Auth::user()->street ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-3">
                                        <label class="form-label mt-4">City</label>
                                        <div class="input-group">
                                            <input id="city" name="city" class="form-control" type="text"
                                                value="{{ Auth::user()->city ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-4">
                                        <label class="form-label mt-4">State</label>
                                        <select class="form-control" name="state" id="state">
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
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mt-4">Mobile Phone</label>
                                <div class="input-group">
                                    <input id="phone_number" name="phone_number" class="form-control" type="number"
                                        value="{{ Auth::user()->phone_number ?? '' }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label mt-4">Email</label>
                                <div class="input-group">
                                    <input id="confirmation" name="email" class="form-control" type="email"
                                        value="{{ Auth::user()->email ?? '' }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">

                            <div class="col-4">
                                <a class="m-auto shadow-xl border-radius-xl">
                                    <img src="{{ Auth::user()->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                                        alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                                </a>
                            </div>
                            <div class="col-4">
                                <label class="form-label mt-4">Profile Picture</label>
                                <div class="input-group">
                                    <input id="photo" name="photo" class="form-control" type="file"
                                        placeholder="">
                                    <span id="photo-response">
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0" id="profile-form-submit"
                                    type="button">Update
                                    Settings</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Card Change Password -->
            <form action="/profile/update-password" method="POST">
                @csrf
                <div class="card mt-4" id="password">

                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body pt-0">




                        <label class="form-label">Current password</label>
                        <div class="form-group">
                            <input class="form-control" type="password" name="current_password"
                                placeholder="Current password" required autocomplete="">
                        </div>
                        <label class="form-label">New password</label>
                        <div class="form-group">
                            <input class="form-control" type="password" name="new_password" placeholder="New password"
                                required autocomplete="">
                        </div>
                        <label class="form-label">Confirm new password</label>
                        <div class="form-group">
                            <input class="form-control" type="password" placeholder="Confirm password"
                                name="confirm_new_password" required autocomplete="">
                        </div>
                        <h5 class="mt-5">Password requirements</h5>
                        <p class="text-muted mb-2">
                            Please follow this guide for a strong password:
                        </p>
                        <ul class="text-muted ps-4 mb-0 float-start">
                            <li>
                                <span class="text-sm">One special characters</span>
                            </li>
                            <li>
                                <span class="text-sm">Min 6 characters</span>
                            </li>
                            <li>
                                <span class="text-sm">One number (2 are recommended)</span>
                            </li>
                            <li>
                                <span class="text-sm">Change it often</span>
                            </li>
                        </ul>
                        <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Update password</button>
                    </div>

                </div>
            </form>
            <!-- Card Change Password -->

            <!-- Card Accounts -->
            <div class="card mt-4" id="accounts">
                <div class="card-header">
                    <h5>Accounts</h5>
                    <p class="text-sm">Here you can setup and manage your integration settings.</p>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex">
                        <img class="width-48-px"
                            src="{{ asset('assets/img/fingerprint-ionic-authentication-android-computer-icons-png-favpng-44g6nMFmJ8dfbmJAeEAeZ6SWp.jpg') }}"
                            alt="finger-print" style="width: 48px; height: 48px;">

                        <div class="my-auto ms-3">
                            <div class="h-100">
                                <h5 class="mb-0">Finger Print & Authenticating Devices</h5>
                                @if (Auth::user()->enable_biometrics)
                                    <a class="text-sm text-body" href="javascript:;" id="hide-details"> Hide Details <i
                                            id="show-details" class="fas fa-chevron-up text-xs ms-1"
                                            aria-hidden="false"></i></a>
                                @else
                                    <a class="text-sm text-body" href="javascript:;" id="show-details"> Show Details </a>
                                @endif

                            </div>
                        </div>
                        <p class="text-sm text-secondary ms-auto me-3 my-auto">
                            @if (Auth::user()->enable_biometrics)
                                Enable
                            @else
                                Disabled
                            @endif
                        </p>
                        <div class="form-check form-switch my-auto">
                            <input class="form-check-input"
                                @if (Auth::user()->enable_biometrics) checked="" @else disabled="" @endif type="checkbox"
                                id="disable-button">
                        </div>
                    </div>
                    <div class="ps-5 pt-3 ms-3 w-100" id="details-box">
                        <p class="mb-0 text-sm">You can login to this site using your <strong>Biometric Device</strong> and
                            <strong>Security Key</strong> to <a href="javascript">Login</a>.
                            without typing a your password. It is save and secure assuring you are the only one accessing
                            your account.

                        </p>
                        <div class="d-sm-flex bg-gray-100 border-radius-lg p-2 my-4">
                            <p class="text-sm font-weight-bold my-auto ps-sm-2">Status</p>
                            @if (Auth::user()->enable_biometrics)
                                <h6 class="text-sm  text-primary ms-auto me-3 my-auto">Enabled</h6>
                            @else
                                <h6 class="text-sm ms-auto me-3 my-auto">Not Using Biometrics</h6>
                            @endif
                        </div>
                        {{-- @dd(Auth::user()->webAuthnCredentials()->count()) --}}
                        @if (Auth::user()->webAuthnCredentials()->count() != 0)
                            @foreach (Auth::user()->webAuthnCredentials()->get() as $authn)
                                <div class="d-sm-flex bg-gray-100 border-radius-lg p-2 my-4 mb-0">
                                    <p class="text-sm my-auto ps-sm-2" title="{{ $authn->id }}">
                                        @if (strpos($authn->device_name, '(android)'))
                                            <i class="fas fa-mobile text-lg opacity-6"></i>
                                        @else
                                            <i class="fas fa-desktop text-lg opacity-6"></i>
                                        @endif
                                        {{-- <strong class="font-weight-bold">KEY:</strong>  --}}
                                        {{-- class="form-check-label text-body ms-3 text-truncate w-80 mb-0" --}}
                                        <label class="text-body  text-truncate w-80 mb-0">
                                            {{ $authn->id }}
                                        </label>
                                        {{-- <label class="text-body ms-3 text-truncate w-50 mb-0">Email me when someone mentions mejhadgyuhyugyj  uiah iauhdiu auigui ihiuah iu hiu</label> --}}
                                        {{-- {{ substr($authn->id, 0, 30) }}... --}}
                                    </p>
                                    <span class="text-sm ms-auto me-3 my-auto text-dark">
                                        @if ($authn->disabled_at == null)
                                            @if ($authn->set_as_default)
                                                <i id="show-details" class=" fas fa-check text-xs ms-3 mb-0"
                                                    aria-hidden="false"></i>
                                            @endif
                                    </span>
                                    <a class="btn btn-sm btn-outline-danger my-sm-auto mb-0"
                                        href="/profile/{{ $authn->authenticatable_id }}/disable-device/{{ $authn->id }}">Disable
                                    </a>
                                    <a class="btn btn-sm bg-gradient-danger my-sm-auto ms-3 mb-0"
                                        href="/profile/{{ $authn->authenticatable_id }}/delete-device/{{ $authn->id }}">Delete</a>
                                @else
                                    <a class="btn btn-sm btn-outline-dark ms-auto me-3 my-auto mb-0"
                                        href="/profile/{{ $authn->authenticatable_id }}/enable-device/{{ $authn->id }}">Enable</a>
                                    <a class="btn btn-sm bg-gradient-danger my-sm-auto mt-2 mb-0"
                                        href="/profile/{{ $authn->authenticatable_id }}/delete-device/{{ $authn->id }}">Delete</a>
                            @endif

                    </div>
                    <hr class="horizontal dark">
                    @endforeach

                    <div class="d-sm-flex border-radius-lg p-2 my-2">
                        <p class="text-sm font-weight-bold my-auto ps-sm-2">Authenticate more device</p>
                        <h6 class="text-sm ms-auto me-3 my-auto text-dark" id="device-supported">
                            Couldn't check your Device
                        </h6>
                        <button class="btn btn-sm bg-gradient-primary my-sm-auto mt-2 mb-0" type="button"
                            id="authenticate-device">Authenticate</button>
                    </div>
                @else
                    <div class="d-sm-flex bg-gray-100 border-radius-lg p-2 my-4">
                        <p class="text-sm font-weight-bold my-auto ps-sm-2">Authenticate your device</p>
                        <h6 class="text-sm ms-auto me-3 my-auto text-dark" id="device-supported">
                            Couldn't check your Device
                        </h6>
                        <button class="btn btn-sm bg-gradient-primary my-sm-auto mt-2 mb-0" type="button"
                            id="authenticate-device">Authenticate</button>
                    </div>
                    @endif
                </div>
            </div>

            <form action="/profile/{{ Auth::id() }}/biometrics-options" method="POST" id="biometrics-options">
                @csrf
                <input type="hidden" name="action" id="activate-deactivate-biometric">
            </form>
        </div>
        <!-- Card Notifications -->
        {{-- <div class="card mt-4" id="notifications">
                <div class="card-header">
                    <h5>Notifications</h5>
                    <p class="text-sm">Choose how you receive notifications. These notification settings apply to the
                        things you’re watching.</p>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-1" colspan="4">
                                        <p class="mb-0">Activity</p>
                                    </th>
                                    <th class="text-center">
                                        <p class="mb-0">Email</p>
                                    </th>
                                    <th class="text-center">
                                        <p class="mb-0">Push</p>
                                    </th>
                                    <th class="text-center">
                                        <p class="mb-0">SMS</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-1" colspan="4">
                                        <div class="my-auto">
                                            <span class="text-dark d-block text-sm">New Uploaded Documents</span>
                                            <span class="text-xs font-weight-normal">Notify when new documents has been
                                                uploaded to site</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                            <input class="form-check-input" checked type="checkbox"
                                                id="flexSwitchCheckDefault11">
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault12"
                                                disabled>
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault13"
                                                disabled>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        <!-- Card Sessions -->
        <div class="card mt-4" id="sessions">
            <div class="card-header pb-3">
                <h5>Sessions</h5>
                <p class="text-sm">This is a list of devices that have logged into your account. .</p>
            </div>
            <div class="card-body pt-0">

                @foreach (DB::table('login_details')->where('user_id', Auth::id())->limit(5)->get() as $logins)
                    @php
                        $details = json_decode($logins->details);
                        // $location = $details->location;
                        if ($details->location) {
                            $location = $details->location;
                        } else {
                            $location = [];
                            // $location = \Stevebauman\Location\Facades\Location::get($user->ip_address) !== false ? Location::get($user->ip_address) : [];
                        }
                        
                    @endphp

                    <div class="d-flex align-items-center">
                        <div class="text-center w-5">
                            @if (strpos($logins->browser, 'android'))
                                <i class="fas fa-mobile text-lg opacity-6"></i>
                            @else
                                <i class="fas fa-desktop text-lg opacity-6"></i>
                            @endif

                        </div>
                        <div class="my-auto ms-3">
                            <div class="h-100">
                                <p class="text-sm mb-1">
                                    {{ $logins->browser }}
                                </p>
                                <p class="mb-0 text-xs">
                                    {{ $logins->ip_address }}

                                </p>
                            </div>
                        </div>
                        <span class="badge badge-success badge-sm my-auto ms-auto me-3">
                            @if (request()->ip() == $logins->ip_address)
                                Active
                            @endif
                        </span>
                        <p class="text-secondary text-sm my-auto me-3">
                            {{ $location ? $location->regionName . ', ' . $location->countryName : '-----' ?? 'No Deatils' }}
                        </p>

                    </div>
                    <hr class="horizontal dark">
                @endforeach


            </div>
        </div>

    </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('vendor/webauthn/webauthn.js') }}"></script>

    <script></script>
    <script>
        // Limit user from selecting more than one document
        $(document).ready(function() {
            // var l = new WebAuthn()

            var deviceSecure = false;

            if (WebAuthn.doesntSupportWebAuthn()) {
                var deviceSecure = false;
                $('#device-supported').text('Your device is not secure enough to use this service').addClass(
                    'text-danger');
                $('#authenticate-device').addClass('d-none');
            } else {
                var deviceSecure = true;
                $('#device-supported').text('Ready');
                $('#authenticate-device').removeClass('d-none');
            }


            if (document.getElementById('state')) {
                var state = document.getElementById('state');
                const example = new Choices(state);
            }







            function visible() {
                var elem = document.getElementById('profileVisibility');
                if (elem) {
                    if (elem.innerHTML == "Switch to visible") {
                        elem.innerHTML = "Switch to invisible"
                    } else {
                        elem.innerHTML = "Switch to visible"
                    }
                }
            }

            var openFile = function(event) {
                var input = event.target;

                // Instantiate FileReader
                var reader = new FileReader();
                reader.onload = function() {
                    imageFile = reader.result;

                    document.getElementById("imageChange").innerHTML = '<img width="200" src="' +
                        imageFile +
                        '" class="rounded-circle w-100 shadow" />';
                };
                reader.readAsDataURL(input.files[0]);
            };



            var inject_browser_data = {{ session('inject_browser_data') ?? 0 }}
            if (inject_browser_data) {
                var biometricsStatus = {
                    user: '{{ Auth::id() }}',
                    email: '{{ Auth::user()->email }}',
                    image: '{{ Auth::user()->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}',
                    name: '{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}',
                    status: 'activated',
                    created_at: '{{ date('d/m/Y H:s:i') }}',
                };
                localStorage.setItem('biometrics_status', JSON.stringify(biometricsStatus));
            }

            var clear_browser_data = {{ session('clear_browser_data') ?? 0 }}
            if (clear_browser_data) {
                localStorage.removeItem('biometrics_status');
            }


            $('#disable-button').change(function() {
                // alert('clicked')

                $('#activate-deactivate-biometric').val('deactivate');
                $('#biometrics-options').submit();

            });

            $('#authenticate-device').click(function() {

                if (deviceSecure === true) {

                    const webAuthn = new WebAuthn({
                        registerOptions: '/webauthn/register/options',
                        register: '/webauthn/register',

                        loginOptions: 'webauthn/login/options',
                        login: '/webauthn/login',
                    });

                    webAuthn.register()
                        .then(response => {
                            const requiredButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn bg-gradient-success',
                                    cancelButton: 'btn bg-gradient-danger',
                                    closeButton: 'btn bg-gradient-primary'
                                },
                                buttonsStyling: false
                            })
                            requiredButtons.fire({
                                title: 'Authenticated',
                                text: 'Device Authentication Successfull!',
                                icon: 'success',
                                showCloseButton: true,
                            })

                            var biometricsStatus = {
                                user: '{{ Auth::id() }}',
                                email: '{{ Auth::user()->email }}',
                                image: '{{ Auth::user()->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}',
                                name: '{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}',
                                status: 'activated',
                                created_at: '{{ date('d/m/Y H:s:i') }}',
                            };
                            localStorage.setItem('biometrics_status', JSON.stringify(biometricsStatus));
                            console.log(response);

                            $('#activate-deactivate-biometric').val('activate');
                            $('#biometrics-options').submit();

                        })
                        .catch(response => {
                            console.log(response);
                            const requiredButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn bg-gradient-success',
                                    cancelButton: 'btn bg-gradient-danger',
                                    closeButton: 'btn bg-gradient-primary'
                                },
                                buttonsStyling: false,
                            })
                            requiredButtons.fire({
                                title: 'Something went wrong, try again!',
                                text: response,
                                icon: 'error',
                                showCloseButton: true,
                            })

                        })
                }

            });

            $('#signature').change(function() {
                validateImage('#signature', 640, 640);
            });

            $('#stamp').change(function() {
                validateImage('#stamp', 640, 640);
            });

            const validateImage = (id, width, height) => {

                var _URL = window.URL || window.webkitURL;
                var file = $(id)[0].files[0];
                img = new Image();
                var imgwidth = 0;
                var imgheight = 0;
                var maxwidth = width;
                var maxheight = height;

                img.src = _URL.createObjectURL(file);
                img.onload = function() {

                    imgwidth = this.width;
                    imgheight = this.height;


                    if (imgwidth <= maxwidth && imgheight <= maxheight) {

                        $(id + "-response").text('');
                        $(id + "-response").removeClass('invalid-feedback');
                        $(id).removeClass('is-valid').attr('data-has-error', false);;
                        return true;

                    } else {

                        $(id + "-response").text("Image size must be " + maxwidth + " x " + maxheight);
                        $(id + "-response").addClass('invalid-feedback');
                        $(id).addClass('is-invalid').attr('data-has-error', true);
                        return false;
                    }
                };

                img.onerror = function() {

                    $(id + "-response").addClass('invalid-feedback');
                    $(id).addClass('is-invalid').attr('data-has-error', true);
                    $(id + "-response").text("not a valid file: " + file.type);
                }
            }

            $('#profile-form-submit').click(function() {
                // e.preventDefault();
                // alert(JSON.stringify(e.form))



                var message = [];

                if ($('#signature').attr('data-has-error') == 'true') {
                    message.push(
                        'Signature will not be uploaded/updated it does not meet the requirement 640 x 50'
                    );
                }

                if ($('#stamp').attr('data-has-error') == 'true') {
                    message.push(
                        'Stamp will not be uploaded/updated it does not meet the requirement 640 x 50');
                }

                // alert(JSON.stringify(message))
                if (message.length !== 0) {
                    var output =
                        '<ul class="list-group" style="justify-content: center; padding: 1em 1.6em 0.3em; text-align: left !important;">';
                    message.forEach((message) => {
                        output +=
                            '<li class="list-group-item border-0 ps-0 pt-0 text-sm"> <span class="text-warning">*</span> ' +
                            message + '</li>';
                    });
                    output += '</ul>';


                    const suggestedButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn bg-gradient-success',
                            cancelButton: 'btn bg-gradient-danger'
                        },
                        buttonsStyling: false
                    })

                    suggestedButtons.fire({
                        title: 'Sure?',
                        html: output,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, continue!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $('#profile-form').submit()
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            //   swalWithBootstrapButtons.fire(
                            //     'Cancelled',
                            //     'Your imaginary file is safe :)',
                            //     'error'
                            //   )
                        }
                    });
                } else {
                    $('#profile-form').submit()
                }
            });

        });
    </script>
    <script></script>
@endsection
