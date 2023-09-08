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
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Invoice - {{ config('app.name', 'Laravel') }}
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/js/fontawesome-kit.js') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/js/plugins/fontawesome-free/css/all.min.css') }}" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.9" rel="stylesheet" />
    <style>
        .navbar-vertical .navbar-brand>img,
        .navbar-vertical .navbar-brand-img {
            max-width: 100%;
            max-height: 10rem;
        }

        .text-gradient.text-own {
            /* background-image: linear-gradient(310deg, #7928CA, #FF0080); */
            background-image: linear-gradient(310deg, #d40000 0%, #2152ff 100%)
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0 text-center" style="white-space:normal;" href="" target="_blank">
                <img src="/logo.jpg" class="navbar-brand-img h-100 rounded " alt="main_logo" style="background: white;">

                <span class="ms-1 font-weight-bolder text-gradient text-own">{{ config('app.name', 'Laravel') }}</span>
            </a>

        </div>
        <hr class="horizontal dark mt-5 mb-0">
        <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link  " href="/dashboard">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Back to Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  " href="/logout">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>customer-support</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(1.000000, 0.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                    </a>
                </li>

            </ul>
        </div>

    </aside>
    <main class="main-content max-height-vh-100 h-100">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky"
            id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-3 text-dark" href="javascript:;">
                                <svg width="12px" height="12px" class="mb-1" viewBox="0 0 45 40"
                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>shop </title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1716.000000, -439.000000)" fill="#252f40"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(0.000000, 148.000000)">
                                                    <path
                                                        d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                    </path>
                                                    <path
                                                        d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                href="javascript:;">Home</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('page-title')
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">@yield('page-title')</h6>
                </nav>
                <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">


                    {{-- <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <button class="btn btn-outline-dark rounded-circle p-2 mb-0" type="button">
            <i class="fas fa-backward p-2"></i>
          </button>
        </div>
        <ul class="navbar-nav d-lg-block d-none">
          <li class="nav-item">
            <a href="https://www.creative-tim.com/product/soft-ui-dashboard-pro" class="btn btn-sm  bg-gradient-primary  btn-round mb-0 me-1" onclick="smoothToPricing('pricing-soft-ui')">Buy Now</a>
          </li>
        </ul> --}}
                    @if (Auth::user()->role != 'student')
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <span class="d-sm-inline d-none text-body font-weight-bold px-3">Viewing</span>

                            <form action="/choose_year" method="post">@csrf
                                <select class="form-control" name="viewing_year" onchange="this.form.submit()">
                                    @foreach (DB::table('years')->orderBy('year', 'DESC')->get() as $year)
                                        <option value="{{ $year->year }}"
                                            @if (DB::table('settings')->value('viewing_year') == $year->year) selected @endif>{{ $year->year }}
                                            @if (DB::table('settings')->value('current_year') == $year->year)
                                                (Current Year)
                                            @endif
                                        </option>
                                    @endforeach

                                </select>
                            </form>


                        </div>
                    @endif
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid my-3 py-3">
            <div class="row">
                <div class="col-md-8 col-sm-10 mx-auto">
                    <form class="" action="index.html" method="post">
                        <div class="card my-sm-5">
                            <div class="card-header">
                                <div class="row d-flex align-items-baseline">
                                    <div class="">
                                        <p style="color: #7e8d9f;font-size: 20px;">Invoice &gt;&gt; <strong>ID:
                                                #{{ $invoice->transaction_id }}</strong></p>
                                    </div>
                                </div>
                                <div class="text-center">
                                  {{-- <i class="far fa-building fa-4x ms-0" style="color:#8f8061 ;"></i> --}}
                                  <img class="mb-2 w-25 p-2" src="../../../assets/img/logo-ct.png" alt="Logo">
                                  <h6>
                                    {{ DB::table('settings')->value('business_name') }}
                                </h6>
                                <p class="d-block text-secondary">tel:
                                    {{ DB::table('settings')->value('whatsapp_number') }}</p>
                              </div>

                            </div>
                            <div class="card-body">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-7 mt-auto">
                                        <ul class="list-unstyled">
                                            <li> <span class="text-secondary mb-0 h6">Billed To: </span> <span
                                                    class="text-dark font-weight-bold">{{ $invoice->full_name }}</span>
                                            </li>
                                            <li> <span
                                                    class="text-secondary mb-0 h6">{{ DB::table('users')->where('id', $invoice->user_id)->value('street') }},
                                                    {{ DB::table('users')->where('id', $invoice->user_id)->value('city') }}</span>
                                            </li>
                                            <li> <span
                                                    class="text-secondary mb-0 h6">{{ DB::table('users')->where('id', $invoice->user_id)->value('state') }},
                                                    Nigeria</span></li>
                                            <li> <span class="text-secondary mb-0 h6"><i class="fas fa-phone"></i>
                                              {{ DB::table('users')->where('id', $invoice->user_id)->value('phone_number') }}</span></li>
                                            </li>
                                        </ul>



                                    </div>
                                    <div class="col-5 mt-auto">

                                        <ul class="list-unstyled">
                                            <li class="text-secondary text-muted"><span
                                                    class="text-dark font-weight-bold">INVOICE</span></li>
                                            <li class="text-secondary"><i class="fas fa-circle"
                                                    style="color:#8f8061 ;"></i> <span
                                                    class="text-dark font-weight-bold">ID:</span>#{{ $invoice->transaction_id }}
                                            </li>
                                            <li class="text-secondary"><i class="fas fa-circle"
                                                    style="color:#8f8061 ;"></i> <span
                                                    class="text-dark font-weight-bold">Creation Date:
                                                </span>{{ Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}
                                            </li>
                                            <li class="text-secondary"><i class="fas fa-circle"
                                                    style="color:#8f8061;"></i> <span
                                                    class="me-1 text-dark font-weight-bold">Status:</span> {{ $invoice->payment_status }}</li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                  
                                    
                                    <div class="{{ $invoice->type == 'Rent Booking' ? 'col-9' : 'col-9' }}  mb-md-0">
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2 py-0">
                                                                {{-- <span class="badge bg-gradient-primary me-3"> </span> --}}
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">Payment for:</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text- text-sm">
                                                            <span class="text-sm font-weight-bold">
                                                                {{ $invoice->type }}  {{ $invoice->type == 'Rent Booking' ? '('.DB::table('rooms')->where('id',DB::table('rents')->where('payment_reference', $invoice->application_no)->value('room_id'))->value('name').')' : '' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                      <td>
                                                          <div class="d-flex px-2 py-0">
                                                              {{-- <span class="badge bg-gradient-primary me-3"> </span> --}}
                                                              <div class="d-flex flex-column justify-content-center">
                                                                  <h6 class="mb-0 text-sm">Method:</h6>
                                                              </div>
                                                          </div>
                                                      </td>
                                                      <td class="align-middle text- text-sm">
                                                          <span class="text-sm font-weight-bold">
                                                              {{ $invoice->payment_method }}
                                                          </span>
                                                      </td>
                                                  </tr>


                                                 
                                                  {{-- @dd(json_decode($invoice->sender_details, true)) --}}
                                                    @if (count(json_decode($invoice->sender_details, true) ?? []) > 0)
                                                        @foreach (json_decode($invoice->sender_details) as $key => $value)
                                                            <tr class="mt-2">
                                                                <td>
                                                                    <div class="d-flex px-2 py-0">
                                                                        {{-- <span class="badge bg-gradient-primary me-3"> </span> --}}
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm">
                                                                                {{ ucwords(str_replace('_', ' ', $key)) }}:
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle text- text-sm">
                                                                    <span class="text-sm font-weight-bold">
                                                                        {{ $value }} </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                  </tbody>

                                            </table>
                                        </div>
                                       
                                    </div>
                                    <div class="col-3 mb-md-0">
                                        <h5 class="mb-2">
                                            @if ($invoice->amount != $invoice->original_amount && $invoice->original_amount != null)
                                                <s class="text-muted me-2 small text-xs align-middle">₦
                                                    {{ number_format($invoice->amount) }}</s> <br>
                                            @endif
                                            <span class="align-middle">₦{{ number_format($invoice->amount) }}</span>
                                        </h5>
                                        @php
                                            $promo_data = json_decode(
                                                DB::table('rents')
                                                    ->where('payment_reference', $invoice->application_no)
                                                    ->value('promo_data'),
                                                true,
                                            );
                                            
                                        @endphp
                                        @if ($invoice->amount != $invoice->original_amount && $invoice->original_amount != null)
                                            <p class="text-danger"><small>You save
                                                    {{ $promo_data['percentage_off'] }}%</small></p>
                                        @endif
                                        @if ($invoice->type == 'Rent Booking')
                                  
                                    <div class="
                                bg-image
                                ripple
                                rounded-5
                                mb-4
                                overflow-hidden
                                d-block
                                "
                                        data-ripple-color="light">
                                        <img src="{{ DB::table('rooms')->where('id',DB::table('rents')->where('payment_reference', $invoice->application_no)->value('room_id'))->value('photo') }}"
                                            class="w-100" height="100px" alt="Elegant shoes and shirt" />
                                        <a href="#!">
                                            <div class="hover-overlay">
                                                <div class="mask"
                                                    style="background-color: hsla(0, 0%, 98.4%, 0.2)"></div>
                                            </div>
                                        </a>
                                    
                                </div>
                                  @endif

                                    </div>
                                </div>
                          
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-5 text-left">
                                        <h5>Thank you!</h5>
                                        <p class="text-secondary text-sm">If you encounter any issues related to the
                                            invoice you can contact us at:</p>
                                        <h6 class="text-secondary mb-0">
                                            email:
                                            <span
                                                class="text-dark">reservations@talentsapartments.com</span>
                                        </h6>
                                    </div>
                                    <div class="col-lg-7 text-end mt-md-0 mt-3">
                                      <ul class="list-unstyled">
                                        <li class=""> <span class="text-secondary mb-0 h6">Total Amont: </span> <span
                                                class="text-dark font-weight-bold h3">₦{{ number_format($invoice->amount) }}</span>
                                        </li>
                                       
                                    </ul>
                                        <button class="btn bg-gradient-info mt-lg-7 mb-0" onClick="window.print()"
                                            type="button" name="button">Print</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                {{ config('app.name', 'Laravel') }}
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with ❤️ by
                                <a href="http://alresia.com" class="font-weight-bold" target="_blank">Alresia Inc</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <p class="nav-link text-muted">Version 1.5</p>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    {{-- <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script> --}}
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- Kanban scripts -->
    <script src="../assets/js/plugins/dragula/dragula.min.js"></script>
    <script src="../assets/js/plugins/jkanban/jkanban.js"></script>
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
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.9"></script>
</body>

</html>
