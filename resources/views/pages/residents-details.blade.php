@extends('layouts.main')
@section('page-title', 'Residents')

@section('content')
    <div class="row mb-5">
        <div class="col-lg-3">
            <div class="card position-sticky top-1">
                <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item">
                        <a class="nav-link text-body" data-scroll="" href="#profile">
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
                            <span class="text-sm">Profile</span>
                        </a>
                    </li>

                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="#school_info">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 44" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                        <a class="nav-link text-body" data-scroll="" href="#guadiant_info">
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
                            <span class="text-sm">Guadiant Info</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="/resident/{{ $resident->user->id }}/guest">
                            <div class="icon me-2">
                                <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 42 44" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                            <span class="text-sm"> Guest</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="/resident/{{ $resident->user->id }}/invoices">
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
                            <span class="text-sm">Invoices</span>
                        </a>
                    </li>
                    @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll="" href="#bedspace">
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
                            <span class="text-sm">Bed Space</span>
                        </a>
                    </li>
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body" data-scroll="" href="#password">
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
                                <span class="text-sm">Change Password</span>
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

                        <li class="nav-item pt-2">
                            <a class="nav-link text-body" data-scroll="" href="#password">
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
                                <span class="text-sm">Change Password</span>
                            </a>
                        </li>

                        

                        <li class="nav-item pt-2">
                            <a class="nav-link text-body" data-scroll="" href="#delete">
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
                                <span class="text-sm"> Account</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-4">

            <form action="/update-resident/{{ $resident->user->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card position-sticky top-1 z-index-2 card-body" id="profile">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-sm-auto col-4">
                            <div class="avatar avatar-xl position-relative">
                                <img src="{{ $resident->user->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                                    alt="bruce" class="w-100 border-radius-lg shadow-sm">
                            </div>
                        </div>
                        <div class="col-sm-auto col-8 my-auto">
                            <div class="h-100">
                                <h5 class="mb-1 font-weight-bolder">
                                    {{ $resident->user->first_name }}
                                    {{ $resident->user->middle_name }}
                                    {{ $resident->user->last_name }}
                                </h5>
                                <p class="mb-0 font-weight-bold text-sm">
                                    {{ ucwords($resident->user->role) }} - {{ $resident->user->ta_uid }}
                                <p class="text-xs font-weight-bold mb-0">{{ $resident->building_name }},
                                    {{ $resident->room_label }}</p>
                                <p class="text-xs text-secondary mb-0">{{ $resident->room_number }},
                                    {{ $resident->room->name }}, {{ $resident->name }}</p>

                                </p>

                            </div>
                        </div>
                        <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                            <a href="/booking_view/{{ $resident->rent->id }}" class="btn bg-gradient-success mb-0 ms-2"
                                type="submit" name="submit">
                                Booking Details</a>
                            @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                <button class="btn bg-gradient-primary mb-0 ms-2" type="submit" name="submit">Update
                                    Account</button>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="card mt-4" id="basic-info">
                    <div class="card-header">
                        <h5>Basic Info</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label">First Name</label>
                                <div class="input-group">
                                    <input id="first_name" name="first_name" class="form-control" type="text"
                                        value="{{ $resident->user->first_name }}" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Middle Name</label>
                                <div class="input-group">
                                    <input id="last_name" name="middle_name" class="form-control" type="text"
                                        value="{{ $resident->user->middle_name }}" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Last Name</label>
                                <div class="input-group">
                                    <input id="last_name" name="last_name" class="form-control" type="text"
                                        value="{{ $resident->user->last_name }}" onfocusout="defocused(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="form-label mt-4">Gender</label>
                                <div class="">
                                    <select class="form-control" name="gender" id="gender" tabindex="-1">
                                        <option value="male" @if ($resident->user->gender == 'male') selected @endif>Male
                                        </option>
                                        <option value="female" @if ($resident->user->gender == 'female') selected @endif>Female
                                        </option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label mt-4">Date of Birth</label>
                                <div class="input-group">
                                    <input id="dob" name="dob" class="form-control" type="date"
                                        value="{{ \Carbon\Carbon::parse($resident->user->dob)->format('Y-m-d') }}"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mt-4">Verificayion code</label>

                                <div class="d-sm-flex bg-gray-100 border-radius-lg">
                                    <p class="text-sm font-weight-bold my-auto ps-sm-2">
                                        @if ($resident->user->verification_code == true)
                                            Verified
                                        @endif
                                    </p>
                                    <input class="form-control form-control-sm ms-sm-auto mt-sm-0 mt-2 w-sm-15 w-50"
                                        type="text" value="{{ $resident->user->verification_code }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mt-4">Email</label>
                                <div class="input-group">
                                    <input id="email" name="email" class="form-control" type="email"
                                        value="{{ $resident->user->email }}" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label mt-4">Phone Number</label>
                                <div class="input-group">
                                    <input id="phone_number" name="phone_number" class="form-control" type="number"
                                        value="{{ $resident->user->phone_number }}" onfocusout="defocused(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label mt-4">Your location (street)</label>
                                <div class="input-group">
                                    <input id="street" name="street" class="form-control" type="text"
                                        value="{{ $resident->user->street }}" onfocus=" focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label mt-4">City</label>
                                <div class="input-group">
                                    <input id="city" name="city" class="form-control" type="text"
                                        value="{{ $resident->user->city }}" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label mt-4">State</label>
                                <select onchange="print_state('state',this.selectedIndex);" id="country"
                                    class="form-control form-control-sm d-none" name="country">
                                </select>
                                <div class="input-group">

                                    <select class="form-control" name="state" id="state">
                                        {{-- <option disabled selected>--Select State--</option>
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
                                        <option value="Zamfara">Zamfara</option> --}}
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <img class="w-50 m-5 img-thumbnail"
                                    src="{{ $resident->user->photo ?? asset('assets/img/no-pics-placeholder.jpg') }}"
                                    alt="logo_slack">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label mt-4">Photo</label>
                                <div class="input-group">
                                    <input id="photo" name="photo" class="form-control" type="file">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card mt-4" id="school_info">
                    <div class="card-header  mb-0 d-flex">
                        <h5 class="mb-0">School Information</h5>

                    </div>

                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-5">
                                <label class="form-label mt-0">School</label>

                                <input value="{{ $resident->user->school }}" type="text" class="form-control"
                                    name="school">

                            </div>
                            <div class="col-sm-3">
                                <label class="form-label mt-0">Level</label>

                                <input value="{{ $resident->user->level }}" type="text" class="form-control"
                                    name="level">

                            </div>
                            <div class="col-sm-4">
                                <label class="form-label mt-0">Course</label>

                                <input value="{{ $resident->user->course }}" type="text" class="form-control"
                                    name="course">

                            </div>
                            <div class="col-sm-4">
                                <label class="form-label mt-4">Depertment</label>
                                <input value="{{ $resident->user->department }}" type="text" class="form-control"
                                    name="department">

                            </div>
                            <div class="col-sm-4">
                                <label class="form-label mt-4">Faculty</label>
                                <input value="{{ $resident->user->faculty }}" type="text" class="form-control"
                                    name="faculty">

                            </div>
                            <div class="col-sm-4">
                                <label class="form-label mt-4">Matric Number</label>
                                <input value="{{ $resident->user->matric_number }}" type="text" class="form-control"
                                    name="matric_number">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4" id="guadiant_info">
                    <div class="card-header">
                        <h5>Guadiant info</h5>
                        <p class="text-sm">Here you can setup and manage your integration settings.</p>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label">Title</label>
                                <div class="input-group">
                                    <select class="form-control" name="g_suffix" id="">
                                        <option>--Title--</option>
                                        <option value="Mr" @if ($resident->user->g_suffix == 'Mr') selected @endif>Mr
                                        </option>
                                        <option value="Mrs" @if ($resident->user->g_suffix == 'Mrs') selected @endif>Mrs
                                        </option>
                                        <option value="Prof" @if ($resident->user->g_suffix == 'Prof') selected @endif>Prof
                                        </option>
                                        <option value="Doc" @if ($resident->user->g_suffix == 'Doc') selected @endif>Doc
                                        </option>
                                        <option value="Engr" @if ($resident->user->g_suffix == 'Engr') selected @endif>Engr
                                        </option>
                                        <option value="Alh" @if ($resident->user->g_suffix == 'Alh') selected @endif>Alh
                                        </option>
                                        <option value="Alj" @if ($resident->user->g_suffix == 'Alj') selected @endif>Alj
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">First Name</label>
                                <div class="input-group">
                                    <input id="g_first_name" name="g_first_name" class="form-control" type="text"
                                        value="{{ $resident->user->g_first_name }}">
                                </div>
                            </div>

                            <div class="col-4">
                                <label class="form-label">Last Name</label>
                                <div class="input-group">
                                    <input id="g_last_name" name="g_last_name" class="form-control" type="text"
                                        value="{{ $resident->user->g_first_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-6">
                                <label class="form-label mt-4">Relationship</label>
                                <div class="input-group">
                                    <select class="form-control" name="g_relationship" id="">
                                        <option disabled selected>--Relationship--</option>
                                        <option value="Father" @if ($resident->user->g_relationship == 'Father') selected @endif>Father
                                        </option>
                                        <option value="Mother" @if ($resident->user->g_relationship == 'Mother') selected @endif>Mother
                                        </option>
                                        <option value="Brother" @if ($resident->user->g_relationship == 'Brother') selected @endif>Brother
                                        </option>
                                        <option value="Sister" @if ($resident->user->g_relationship == 'Sister') selected @endif>Sister
                                        </option>
                                        <option value="Uncle" @if ($resident->user->g_relationship == 'Uncle') selected @endif>Uncle
                                        </option>
                                        <option value="Aunty" @if ($resident->user->g_relationship == 'Aunty') selected @endif>Aunty
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mt-4">Email</label>
                                <div class="input-group">
                                    <input id="g_email" name="g_email" class="form-control" type="email"
                                        value="{{ $resident->user->g_email }}" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label mt-4">Phone Number</label>
                                <div class="input-group">
                                    <input id="g_phone_number" name="g_phone_number" class="form-control" type="number"
                                        value="{{ $resident->user->g_phone_number }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label mt-4">Your location (street)</label>
                                <div class="input-group">
                                    <input id="g_street" name="g_street" class="form-control" type="text"
                                        value="{{ $resident->user->g_street }}" onfocus=" focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label mt-4">City</label>
                                <div class="input-group">
                                    <input id="g_city" name="g_city" class="form-control" type="text"
                                        value="{{ $resident->user->g_city }}" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label mt-4">State</label>
                                <div class="input-group">
                                    <select class="form-control" name="g_state" id="g_state">
                                        {{-- <option disabled selected>--Select State--</option>
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
                                        <option value="Zamfara">Zamfara</option> --}}
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="card mt-4" id="bedspace">
                <div class="card-header">
                    <h5>User Room/Bedspace</h5>
                    <p class="text-sm mb-0">You can remove resident from the room
                    </p>
                    {{-- <p class="text-sm mb-0">You can preview to see if lawyer has signed on it or not
                    </p> --}}
                </div>
                <div class="card-body pt-0">
                    <hr class="horizontal dark">
                        <div class="d-flex">
                            <img style="width: 48px; height: 48px;" class="img img-circle width-48-px" src="{{ $resident->room->photo }}" alt="logo_spotify">
                            <div class="my-auto ms-3">
                              <div class="h-100 d-flex">
                                <div class=" me-3">
                                    <h5 class="mb-0">{{ $resident->room->name }}</h5>
                                    <p class="text-xs text-secondary mb-0"> <span class="text-xs font-weight-bold mb-0">{{ $resident->building_name }}, {{ $resident->room_label }}</span> - {{ $resident->room_number }}, {{ $resident->name }}</p>
                                </div>
                                
                                <div>
                                   
                                    
                                </div>
                                {{-- <p class="text-sm text-secondary ms-auto me-3 my-auto">
                                    
                                    </p> --}}
                                </div>
                            </div>
                            
                            {{-- <p class="text-sm text-secondary ms-auto me-3 my-auto">
                                @if ($agreement_form->consent()->where('user_id', $resident->user->id)->first() != null) Accepted @else  Awaiting Acceptance @endif
                                </p> --}}
                                <a href="/bedspace/{{ $resident->id }}/remove-resident" class="btn bg-gradient-danger btn-sm  ms-auto me-3 my-auto">Remove</a>
                              
                           
                          </div>
                </div>
            </div>
            <div class="card mt-4" id="documents">
                <div class="card-header">
                    <h5>User Consent of Documents</h5>
                    <p class="text-sm mb-0">Here are List of Documents that has been accepted by user
                    </p>
                    <p class="text-sm mb-0">You can preview to see if lawyer has signed on it or not
                    </p>
                </div>
                <div class="card-body pt-0">
                    @foreach (\App\Models\Documents::where('type', 'agreement_form')->get() as $agreement_form)
                        <hr class="horizontal dark">
                        <div class="d-flex">
                            <img style="width: 48px; height: 48px;" class="width-48-px" src="{{ asset('document-files/document-icon.jpeg') }}" alt="logo_spotify">
                            <div class="my-auto ms-3">
                              <div class="h-100">
                                <h5 class="mb-0">{{ $agreement_form->title }}</h5>
                                <a href="/document/print/{{ $agreement_form->id }}/user/{{ $resident->user->id }}" class="mb-0 text-sm text-primary">view document</a>
                              </div>
                            </div>
                            
                            <p class="text-sm text-secondary ms-auto me-3 my-auto">
                                @if ($agreement_form->consent()->where('user_id', $resident->user->id)->first() != null) Accepted @else  Awaiting Acceptance @endif
                                </p>
                           
                          </div>

                        
                        @endforeach
                </div>
            </div>
            @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin' || Auth::user()->role == 'staff')

                <form action="/update-user-password/{{ $resident->user->id }}" method="POST">
                    @csrf
                    <div class="card mt-4" id="password">
                        <div class="card-header">
                            <h5>Change Password</h5>
                        </div>
                        <div class="card-body pt-0">
                            <label class="form-label">New password</label>
                            <div class="form-group">
                                <input class="form-control @error('password') is-invalid @enderror" name="newPassword"
                                    type="password" value="" required>
                                @error('newPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label class="form-label">Confirm new password</label>
                            <div class="form-group">
                                <input class="form-control @error('password') is-invalid @enderror"
                                    name="confirmNewPassword" type="password" value="" required>
                                @error('newPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                    <span class="text-sm">Min 8 characters</span>
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

                <div class="card mt-4" id="delete">
                    <div class="card-header">
                        <h5>Delete User Account</h5>
                        <p class="text-sm mb-0">Once you delete your account, there is no going back. Please be
                            certain.
                        </p>
                    </div>
                    <div class="card-body pt-0">
                        <form action="/delete-user/{{ $resident->user->id }}" method="POST">
                            @csrf
                            <div class="d-flex">

                                <div class="d-flex align-items-center mb-sm-0 mb-4">
                                    <div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" name="confirm_delete_user"
                                                id="flexSwitchCheckDefault0">
                                        </div>
                                    </div>
                                    <div class="ms-2">
                                        <span class="text-dark font-weight-bold d-block text-sm">Confirm</span>
                                        <span class="text-xs d-block">I want to delete user account.</span>
                                    </div>
                                </div>

                                <p class="text-secondary text-sm ms-auto my-auto me-3"></p>
                                <button class="btn btn-sm bg-gradient-danger mb-0 " type="submit" id="delete_user"
                                    disabled>Delete
                                    Account</button>

                            </div>
                        </form>
                        <hr class="horizontal dark">
                        <div class="d-flex">
                            <p class="text-dark font-weight-bolder my-auto">Enable
                                Login</p>

                            {{-- <button class="btn btn-sm btn-outline-dark mb-0" type="button">Add</button> --}}
                            @if (DB::table('users')->where('id', $resident->user->id)->value('disable_login') == true)
                                <p class="text-secondary text-sm ms-auto my-auto me-3">Disabled</p>

                                <form action="/enable-resident/{{ $resident->user->id }}">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" onchange="this.form.submit()">
                                    </div>
                                </form>
                            @else
                                <p class="text-secondary text-sm ms-auto my-auto me-3">Enabled</p>
                                <form action="/disable-resident/{{ $resident->user->id }}">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" onchange="this.form.submit()"
                                            checked>
                                    </div>
                                </form>
                            @endif
                        </div>

                        <hr class="horizontal dark">
                        <div class="d-flex">
                            <p class="text-dark font-weight-bolder my-auto">Allow Resident Update Profile Picture</p>

                            {{-- <button class="btn btn-sm btn-outline-dark mb-0" type="button">Add</button> --}}
                            @if (DB::table('users')->where('id', $resident->user->id)->value('disable_picture_update') == true)
                                <p class="text-secondary text-sm ms-auto my-auto me-3">Disabled</p>

                                <form action="/allow-change-profile-picture/{{ $resident->user->id }}">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" onchange="this.form.submit()">
                                    </div>
                                </form>
                            @else
                                <p class="text-secondary text-sm ms-auto my-auto me-3">Enabled</p>
                                <form action="/disallow-change-profile-picture/{{ $resident->user->id }}">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" onchange="this.form.submit()"
                                            checked>
                                    </div>
                                </form>
                            @endif
                        </div>

                        <hr class="horizontal dark">
                        <div class="d-flex">
                            <p class="text-dark font-weight-bolder my-auto">Allow Recieve Guest</p>

                            {{-- <button class="btn btn-sm btn-outline-dark mb-0" type="button">Add</button> --}}
                            @if (DB::table('users')->where('id', $resident->user->id)->value('disable_guest') == true)
                                <p class="text-secondary text-sm ms-auto my-auto me-3">Disabled</p>

                                <form action="/enable-guest/{{ $resident->user->id }}">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" onchange="this.form.submit()">
                                    </div>
                                </form>
                            @else
                                <p class="text-secondary text-sm ms-auto my-auto me-3">Enabled</p>
                                <form action="/disable-guest/{{ $resident->user->id }}">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" onchange="this.form.submit()"
                                            checked>
                                    </div>
                                </form>
                            @endif
                        </div>

                        @if (DB::table('users')->where('id', $resident->user->id)->value('disable_guest') != true)
                        <form action="/update-max-guest-per-day/{{ $resident->user->id }}">
                            <div class="d-sm-flex bg-gray-100 border-radius-lg p-2 my-4">
                                <div>
                                    <p class="text-sm font-weight-bold my-auto ps-sm-2">Max Guest Per Day</p>
                                    <span class="my-auto ps-sm-2 text-xs d-block">Note if you change this value it will
                                        over ride the global value.</span>
                                </div>
                                

                                    <input
                                        class="form-control form-control-sm ms-auto me-3 my-auto ms-sm-auto mt-sm-0 mt-2 w-sm-15 w-40"
                                        type="number"
                                        name="value"
                                        value="{{ DB::table('users')->where('id', $resident->user->id)->value('max_guest_per_day') ?? DB::table('settings')->value('global_max_guest_per_day') }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Copy!"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                    <button class="btn btn-sm bg-gradient-primary my-sm-auto mt-2 mb-0" type="submit"
                                        name="button">Upgrade</button>
                                
                            </div>
                        </form>
                        @endif



                    </div>
                </div>

            @endif

        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="/assets/js/countries.js"></script>
    <script>
        // Limit user from selecting more than one amenities
        $(document).ready(function() {

            //Make default country & state selected
            var state = '{{ $resident->user->state ?? '' }}';
            print_country("country", "Nigeria")
            var get_country_index = $("#country")[0].selectedIndex
            if (get_country_index && state) {
                print_state('state', get_country_index, '{{ $resident->user->state ?? '' }}')
            }
            //Make default country & state selected
            var g_state = '{{ $resident->user->g_state ?? '' }}';
            print_country("country", "Nigeria")
            var get_country_index = $("#country")[0].selectedIndex
            if (get_country_index && g_state) {
                print_state('g_state', get_country_index, '{{ $resident->user->g_state ?? '' }}')
            }

            $("input[name='amenities[]']").change(function() {
                var maxAllowed = 10;
                var cnt = $("input[name='amenities[]']:checked").length;
                if (cnt > maxAllowed) {
                    $(this).prop("checked", "");

                    $('#amenities-error').attr({
                        "class": "text-danger",
                        "role": "alert"
                    });
                }
            });

            $("input[name='confirm_delete_user']").change(function() {

                if ($("input[name='confirm_delete_user']").val() == 'on') {
                    $("#delete_user").attr({
                        "disabled": false,
                        // "role": "alert"
                    });

                }

            });
            // Select all elements with data-toggle="popover" in the document
            // $('[data-toggle="popover"]').popover();

        });
    </script>
@endsection
