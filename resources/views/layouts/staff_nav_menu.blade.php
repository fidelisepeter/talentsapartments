<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0 text-center"
        style="white-space:normal;"
            href=""
            target="_blank">
            <img src="/logo.jpg" class="navbar-brand-img h-100 rounded " alt="main_logo">
        
            {{-- <span class="ms-1 font-weight-bolder text-gradient text-own">{{ config('app.name', 'Laravel') }}</span> --}}
        </a>
    </div>
     <hr class="horizontal dark mt-5 mb-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
            @can('view-dashboard')
            <li class="nav-item">
                
                    
                
                <a class="nav-link  " href="/dashboard">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>shop </title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
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
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link  " href="/profile/settings">
                  <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>shop </title>
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(0.000000, 148.000000)">
                              <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                              <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </div>
                  <span class="nav-link-text ms-1">My Profile</span>
                </a>
              </li>
                  @can('view-bookings')
                      
                 
            <li class="nav-item">
                <a class="nav-link  @if (request()->is('booking_view*')) active @endif" href="/bookings">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>box-3d-50</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                  <g transform="translate(603.000000, 0.000000)">
                                    <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z"></path>
                                    <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
                                    <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
                                  </g>
                                </g>
                              </g>
                            </g>
                          </svg>
                      </div>
                    <span class="nav-link-text ms-1">Bookings</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link  " href="/progress_bar">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>office</title>
                            <g stroke="none" stroke-width="1" fill="#fff" fill-rule="evenodd">
                              <g transform="translate(-1869.000000, -293.000000)" fill="#fff" fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                  <g id="office" transform="translate(153.000000, 2.000000)">
                                    <path class="color-background" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z" opacity="0.6"></path>
                                    <path class="color-background" d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z"></path>
                                  </g>
                                </g>
                              </g>
                            </g>
                          </svg>
                      </div>
                    <span class="nav-link-text ms-1">Progress Bar</span>
                </a>
            </li>
            @endcan
            @can('view-residents')
           
            <li class="nav-item">

                <a class="nav-link @if (request()->is('resident*')) active @endif" data-bs-toggle="collapse" data-toggle="collapse" role="button" href="#residents"
                    aria-expanded="false" aria-controls="residents">
<div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
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
                    <span class="nav-link-text ms-1">Residents</span>
                </a>
                <div class="collapse @if (request()->is('resident*')) show @endif" id="residents">
                    <ul class="nav flex-column nav ms-4 ps-3 sub-menu">
                        
                        <li class="nav-item">
                            <a class="nav-link @if (request()->is('resident*')) active @endif" href="/residents">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i> </span>
                                <span class="sidenav-normal">All Residents </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="/bookings/archived">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Archived </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="/users">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> All site users </span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            @endcan
            @can('view-guests')
            <li class="nav-item">

                <a class="nav-link @if (request()->is('guest*')) active @endif" data-bs-toggle="collapse" data-toggle="collapse" role="button" href="#guests"
                    aria-expanded="false" aria-controls="guests">
<div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
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
                    <span class="nav-link-text ms-1">Guests</span>
                </a>
                <div class="collapse @if (request()->is('guest*')) show @endif" id="guests">
                    <ul class="nav flex-column nav ms-4 ps-3 sub-menu">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="/guest/code-page">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i> </span>
                                <span class="sidenav-normal">Code Page </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/guest">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i> </span>
                                <span class="sidenav-normal">All Guest</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="/guest/settings">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Settings </span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            @endcan
            

            <li class="nav-item">

                <a class="nav-link" data-bs-toggle="collapse" data-toggle="collapse" role="button" href="#ui-basic"
                    aria-expanded="false" aria-controls="ui-basic">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>shop </title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                            <path class="color-background"
                                                d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"
                                                opacity="0.598981585"></path>
                                            <path class="color-background"
                                                d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Rooms</span>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column nav ms-4 ps-3 sub-menu">
                        @can('view-rooms')
                        <li class="nav-item">
                            <a class="nav-link" href="/rooms">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> All Rooms </span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="/room-list">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Room List </span>
                            </a>
                        </li>
                        @endcan
              
                        @can('view-room-types')
                        <li class="nav-item">
                            <a class="nav-link" href="/room-types">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Types </span>
                            </a>
                        </li>
                        @endcan
                        @can('view-bedspace')
                        <li class="nav-item">
                            <a class="nav-link" href="/bedspaces">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Bed Spaces </span>
                            </a>
                        </li>
                        @endcan
                        @can('view-amenities')
                        <li class="nav-item ">
                            <a class="nav-link " href="/room-amenities">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Amenities </span>
                            </a>
                        </li>
                        @endcan
                        @can('view-locations')
                        <li class="nav-item ">
                            <a class="nav-link " href="/room-locations">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Locations </span>
                            </a>
                        </li>
                        @endif
                        @can('view-buildings')
                        <li class="nav-item ">
                            <a class="nav-link " href="/buildings">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Buildings </span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @can('view-products')
            <li class="nav-item">
                <a class="nav-link  " href="/all-products">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <svg class="text-dark" width="12px" height="12px" viewBox="0 0 42 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>basket</title>
                            <g stroke="none" stroke-width="1" fill="#6c757d" fill-rule="evenodd">
                              <g transform="translate(-1869.000000, -741.000000)" fill="#6c757d" fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                  <g id="basket" transform="translate(153.000000, 450.000000)">
                                    <path class="color-background" d="M34.080375,13.125 L27.3748125,1.9490625 C27.1377583,1.53795093 26.6972449,1.28682264 26.222716,1.29218729 C25.748187,1.29772591 25.3135593,1.55890827 25.0860125,1.97535742 C24.8584658,2.39180657 24.8734447,2.89865282 25.1251875,3.3009375 L31.019625,13.125 L10.980375,13.125 L16.8748125,3.3009375 C17.1265553,2.89865282 17.1415342,2.39180657 16.9139875,1.97535742 C16.6864407,1.55890827 16.251813,1.29772591 15.777284,1.29218729 C15.3027551,1.28682264 14.8622417,1.53795093 14.6251875,1.9490625 L7.919625,13.125 L0,13.125 L0,18.375 L42,18.375 L42,13.125 L34.080375,13.125 Z" opacity="0.595377604"></path>
                                    <path class="color-background" d="M3.9375,21 L3.9375,38.0625 C3.9375,40.9619949 6.28800506,43.3125 9.1875,43.3125 L32.8125,43.3125 C35.7119949,43.3125 38.0625,40.9619949 38.0625,38.0625 L38.0625,21 L3.9375,21 Z M14.4375,36.75 L11.8125,36.75 L11.8125,26.25 L14.4375,26.25 L14.4375,36.75 Z M22.3125,36.75 L19.6875,36.75 L19.6875,26.25 L22.3125,26.25 L22.3125,36.75 Z M30.1875,36.75 L27.5625,36.75 L27.5625,26.25 L30.1875,26.25 L30.1875,36.75 Z"></path>
                                  </g>
                                </g>
                              </g>
                            </g>
                          </svg>
                      </div>
                    <span class="nav-link-text ms-1">Products</span>
                </a>
            </li>
            @endcan
           
            
            
            <li class="nav-item">


                <a class="nav-link" data-bs-toggle="collapse" data-toggle="collapse" role="button"
                    href="#paymentNav" aria-expanded="false" aria-controls="paymentNav">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>credit-card</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(453.000000, 454.000000)">
                                            <path class="color-background opacity-6"
                                                d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Payments</span>
                </a>
               
               
                @can('view-payments')
                <div class="collapse" id="paymentNav">
                    <ul class="nav flex-column nav ms-4 ps-3 sub-menu">
                        @can('view-invoices')
                        <li class="nav-item">
                            <a class="nav-link" href="/invoices">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Invoices </span>
                            </a>
                        </li>
                        @endcan
                        @can('view-payments')
                        <li class="nav-item">
                            <a class="nav-link" href="/direct-payments">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Manual Payment </span>
                            </a>
                        </li>
                        @endcan
                        

                        @can('view-financials')
                        <li class="nav-item">
                            <a class="nav-link" href="/financials">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Financials </span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>
            @endcan

            @can('view-document')
            <li class="nav-item">
                <a class="nav-link  @if (request()->is(['document/**'])) active @endif" href="/document">
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
                    <span class="nav-link-text ms-1">Documents</span>
                </a>
            </li>
            @endcan

            @can('view-inventory')
            <li class="nav-item">


                <a class="nav-link" data-bs-toggle="collapse" data-toggle="collapse" role="button"
                    href="#inventoryNav" aria-expanded="false" aria-controls="inventoryNav">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>credit-card</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(453.000000, 454.000000)">
                                            <path class="color-background opacity-6"
                                                d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Inventory</span>
                </a>
                <div class="collapse" id="inventoryNav">
                    <ul class="nav flex-column nav ms-4 ps-3 sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="/inventories">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> All Items </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/inventories/purchased">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Purchased Items </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/inventories/categories">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Categories </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/inventories/create">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Add Item </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            @endcan
            @can('view-complaints')
            <li class="nav-item">
                <a class="nav-link  " href="/complaints">
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
                    <span class="nav-link-text ms-1">Complaints</span>
                </a>
            </li>

            @endcan

            @can('view-staff')

            <li class="nav-item">


                <a class="nav-link @if (request()->is(['staff/**','role/**'])) active @endif" data-bs-toggle="collapse" data-toggle="collapse" role="button"
                    href="#staffNav" aria-expanded="false" aria-controls="staffNav">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(304.000000, 151.000000)">
                                            <polygon class="color-background opacity-6"
                                                points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                            </polygon>
                                            <path class="color-background opacity-6"
                                                d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Staffs</span>
                </a>
                <div class="collapse @if (request()->is(['staff/**','role/**','lawyer/**'])) show @endif" id="staffNav">
                    <ul class="nav flex-column nav ms-4 ps-3 sub-menu">
                        @can('create-staff')
                        <li class="nav-item">
                            <a class="nav-link" href="/staff/create">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> New Staff </span>
                            </a>
                        </li>
                        @endcan
                        
                        <li class="nav-item">
                            <a class="nav-link @if (request()->is('staff/**')) active @endif" href="/staff">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> All Staff </span>
                            </a>
                        </li>
                        @can('view-lawyer')
                        <li class="nav-item">
                            <a class="nav-link @if (request()->is('lawyer/**')) active @endif" href="/lawyer">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Lawyers </span>
                            </a>
                        </li>
                        @endcan
                        @can('view-roles')
                        <li class="nav-item">
                            <a class="nav-link @if (request()->is('role/**')) active @endif" href="/role">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Roles </span>
                            </a>
                        </li>
                        @endcan
                        @can('view-department')
                        <li class="nav-item">
                            <a class="nav-link" href="/department">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Departments </span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>
            @endcan

            <li class="nav-item">


                <a class="nav-link" data-bs-toggle="collapse" data-toggle="collapse" role="button"
                    href="#settingNav" aria-expanded="false" aria-controls="settingNav">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(304.000000, 151.000000)">
                                            <polygon class="color-background opacity-6"
                                                points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                            </polygon>
                                            <path class="color-background opacity-6"
                                                d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Settings</span>
                </a>
                <div class="collapse" id="settingNav">
                    <ul class="nav flex-column nav ms-4 ps-3 sub-menu">
                        @can('view-settings')
                        <li class="nav-item">
                            <a class="nav-link" href="/settings">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Site Settings </span>
                            </a>
                        </li>
                        @endcan
                        @can('view-promo')
                        <li class="nav-item">
                            <a class="nav-link" href="/all-promo">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Promo/Referral </span>
                            </a>
                        </li>
                        @endcan
                        @can('view-email-templates')
                        <li class="nav-item">
                            <a class="nav-link" href="/email-templates">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Email Template </span>
                            </a>
                        </li>
                        @endcan
                        @can('view-administrators')
                        <li class="nav-item">
                            <a class="nav-link" href="/administrators">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Administrators </span>
                            </a>
                        </li>
                        @endcan
                        @can('view-login-activities')
                        <li class="nav-item">
                            <a class="nav-link" href="/users-login-activities">
                                <span class="sidenav-mini-icon"> <i class="fa fa-circle"></i>  </span>
                                <span class="sidenav-normal"> Login Users </span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>
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
    <div class="sidenav-footer mx-3 mt-3 pt-3">
      
    </div>
  </aside>