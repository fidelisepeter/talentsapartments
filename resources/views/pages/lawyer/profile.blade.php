@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('page-title', 'Lawyers')
@section('content')
    @php
        $page_title = Auth::user()->first_name . ' ' . Auth::user()->middle_name . ' ' . Auth::user()->last_name . ' Documents';
        
        $count_of_documents = count(Auth::user()->lawyer->documents());
        $count_of_completed_signed_documents = count(
            \App\Models\SignedDocuments::where('lawyer_id', Auth::id())
                ->where('signatures_status', 'completed')
                ->where('stamps_status', 'completed')
                ->where('names_status', 'completed')
                ->get(),
        );
        $count_of_incompleted_signed_documents = count(
            \App\Models\SignedDocuments::where('lawyer_id', Auth::id())
                ->where([
                    ['signatures_status', 'pending'],
                    [
                        function ($query) {
                            $query->orWhere('stamps_status', 'pending')->get();
                            $query->orWhere('stamps_status', 'pending')->get();
                        },
                    ],
                ])
                ->get(),
        );
        $count_of_pending_documents = $count_of_documents - ($count_of_completed_signed_documents + $count_of_incompleted_signed_documents);
        
    @endphp
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('{{ Auth::user()->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ Auth::user()->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                            alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ Auth::user()->first_name ?? '' }}
                            {{ Auth::user()->middle_name ?? '' }}
                            {{ Auth::user()->last_name ?? '' }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ Auth::user()->role ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent flex-row" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"
                                    role="tab" aria-selected="true">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                                    <span class="ms-1">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="/document" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1"
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
                                    <span class="ms-1">Users</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="/profile/settings"
                                    role="tab" aria-selected="false" tabindex="-1">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                                    <span class="ms-1">Settings</span>
                                </a>
                            </li>
                            <div class="moving-tab position-absolute nav-link"
                                style="padding: 0px; transition: all 0.5s ease 0s; transform: translate3d(0px, 0px, 0px); width: 73px;">
                                <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"
                                    role="tab" aria-selected="true">-</a></div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Platform Settings</h6>
                </div>
                <div class="card-body p-3">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
                    <ul class="list-group">
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-auto" type="checkbox" id="enable_doc_email" @if (Auth::user()->email_on_new_doc) checked @endif>
                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                    for="enable_doc_email">Email when new document is uploaded</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1"
                                    checked disabled>
                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                    for="flexSwitchCheckDefault1">Keep me logged in in this browser</label>
                            </div>
                        </li>

                    </ul>
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Security</h6>
                    <ul class="list-group">
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-auto" type="checkbox"  id="enable_biometric"
                                @if (Auth::user()->enable_biometric) checked @endif>
                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                    for="enable_biometric">
                                    Enable Biometric Login</label>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Profile Information</h6>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="/profile/settings">
                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" aria-label="Edit Profile"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    @if (Auth::user()->bio)
                        <p class="text-sm">
                            {{ Auth::user()->bio }}
                        </p>
                    @else
                        <p class="text-sm opacity-3">
                            Your bio will be displayed here. update your profile from settings
                        </p>
                    @endif

                    <hr class="horizontal gray-light my-4">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                Name:</strong> &nbsp;
                            {{ Auth::user()->first_name . ' ' . Auth::user()->middle_name . ' ' . Auth::user()->last_name }}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong>
                            &nbsp; {{ Auth::user()->phone_number }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp;
                            {{ Auth::user()->email }} </li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong>
                            &nbsp; {{ Auth::user()->street }}, {{ Auth::user()->city }}, {{ Auth::user()->state }}</li>
                        {{-- <li class="list-group-item border-0 ps-0 pb-0">
              <strong class="text-dark text-sm">Social:</strong> &nbsp;
              <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                <i class="fab fa-facebook fa-lg"></i>
              </a>
              <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                <i class="fab fa-twitter fa-lg"></i>
              </a>
              <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                <i class="fab fa-instagram fa-lg"></i>
              </a>
            </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 mt-xl-0 mt-4">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Documents overview</h6>

                </div>
                <div class="card-body p-3">

                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                    <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        class="mt-1">
                                        <title>customer-support</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(1.000000, 0.000000)">
                                                        <path class="color-background"
                                                            d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"
                                                            opacity="0.59858631"></path>
                                                        <path class="color-foreground"
                                                            d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                                        </path>
                                                        <path class="color-foreground"
                                                            d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Total Documents</h6>
                                    <span class="text-xs font-weight-bold"> {{ $count_of_documents }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-warning shadow text-center">
                                    <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        class="mt-1">
                                        <title>customer-support</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(1.000000, 0.000000)">
                                                        <path class="color-background"
                                                            d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"
                                                            opacity="0.59858631"></path>
                                                        <path class="color-foreground"
                                                            d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                                        </path>
                                                        <path class="color-foreground"
                                                            d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Pending</h6>
                                    <span class="text-xs font-weight-bold">{{ $count_of_pending_documents }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-primary shadow text-center">
                                    <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        class="mt-1">
                                        <title>customer-support</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(1.000000, 0.000000)">
                                                        <path class="color-background"
                                                            d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"
                                                            opacity="0.59858631"></path>
                                                        <path class="color-foreground"
                                                            d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                                        </path>
                                                        <path class="color-foreground"
                                                            d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Incompleted</h6>
                                    <span class="text-xs font-weight-bold">
                                        {{ $count_of_incompleted_signed_documents }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                                    <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        class="mt-1">
                                        <title>customer-support</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(1.000000, 0.000000)">
                                                        <path class="color-background"
                                                            d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"
                                                            opacity="0.59858631"></path>
                                                        <path class="color-foreground"
                                                            d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                                        </path>
                                                        <path class="color-foreground"
                                                            d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Completed</h6>
                                    <span class="text-xs font-weight-bold">
                                        {{ $count_of_completed_signed_documents }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Assigned Document</h5>
                            <p class="text-sm mb-0">
                                {{-- COunt: {{$documents->count()}} --}}
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">



                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table id="document-table" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Type</th>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Assigned To</th> --}}
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date uploaded</th>
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th> --}}
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->lawyer->documents() as $document)
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-sm">
                                                {{ $document->title ?? '' }}

                                            </h6>
                                        </td>
                                        <td>
                                            <p class="text-sm text-secondary mb-0">{{ $document->type ?? '' }}</p>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <p class="text-secondary mb-0 text-sm">{{ $document->created_at ?? '' }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center">
                                                <a class="text-dark text-sm mx-3"
                                                    href="{{ asset($document->document_path) }}"> View Document</a>

                                            </div>
                                            <span class="text-secondary text-sm"></span>
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>



@endsection
@section('script')
    <script>
        // Limit user from selecting more than one document
        $(document).ready(function() {

          $('#enable_biometric').change(function() {
               
                location.assign('/profile/settings');

            });
         
            $('#enable_doc_email').on('change', function() {

              location.assign('/profile/settings');
            });
        });
    </script>
@endsection
