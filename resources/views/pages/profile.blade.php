@extends('layouts.main')
@section('page-title', 'Profile')
@section('content')


<div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../../../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
  </div>
  <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
          <img src="{{ auth()->user()->photo ?? '../assets/img/no-image.png' }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            {{ auth()->user()->first_name }}
            {{ auth()->user()->middle_name }}
            {{ auth()->user()->last_name }} 
           
          </h5>
          <p class="mb-0 font-weight-bold text-sm">
            @if (DB::table('bed_spaces')->where('user_id', $user->id)->value('user_id') == $user->id) Resident/ @else User @endif  {{ auth()->user()->ta_uid ?? '' }}
          </p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
        <div class="nav-wrapper position-relative end-0">
          <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
            @if (\App\Models\BedSpace::where('id', DB::table('rents')->where('id',  Auth::user()->current_rent)->value('bed_space'))->first() && DB::table('rents')->where('id',  Auth::user()->current_rent)->value('status') == 'Approved')
              @if (DB::table('users')->where('id', Auth::user()->id)->value('disable_picture_update') == false)                  
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active " data-toggle="modal"
                data-target="#update-profile">
                  <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                        <g transform="translate(1716.000000, 291.000000)">
                          <g transform="translate(603.000000, 0.000000)">
                            <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                            </path>
                            <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
                            <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
                  <span class="ms-1">Update Photo</span>
                </a>
              </li>
              @endif
            @endif
            {{-- <li class="nav-item">
              <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>document</title>
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                      <g transform="translate(1716.000000, 291.000000)">
                        <g transform="translate(154.000000, 300.000000)">
                          <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" opacity="0.603585379"></path>
                          <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                          </path>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
                <span class="ms-1">Messages</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>settings</title>
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                      <g transform="translate(1716.000000, 291.000000)">
                        <g transform="translate(304.000000, 151.000000)">
                          <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                          </polygon>
                          <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                          <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
                          </path>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
                <span class="ms-1">Settings</span>
              </a>
            </li> --}}
          </ul>
        </div>
      </div>
    </div>
  </div>

<div class="row mt-3">
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card mb-3">
            <div class="card-body p-3">
                <div class="row">


                    <div class="col-8">
                        <div class="numbers">
                            <p class="mb-0 text-capitalize font-weight-bold">Rent Status</p>
                            @if (!empty(
                                DB::table('rents')->where('id', $user->current_rent)->value('expiring_date')
                            ) &&
                                DB::table('rents')->where('id', $user->current_rent)->value('expiring_date') < \Carbon\Carbon::now())
                                <h5 class="text-danger  font-weight-bolder mb-0">
                                    Expired
                                    <span class="text-dark text-sm opacity-6">
                                        {{\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse(DB::table('rents')->where('id',  $user->current_rent)->value('expiring_date')))}} day(s) Ago</span>
                                </h5>
                            @elseif (DB::table('rents')->where('id', $user->current_rent)->value('status') == 'Approved')
                                <h5 class="text-success  font-weight-bolder mb-0">
                                    Active
                                    <span class="text-dark text-sm opacity-6">
                                        {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse(DB::table('rents')->where('id', $user->current_rent)->value('expiring_date'))) }}
                                        day(s) left</span>
                                </h5>
                            @else
                                <h5 class="text-warning  font-weight-bolder mb-0">
                                    {{ DB::table('rents')->where('id', $user->current_rent)->value('status') }}

                                </h5>
                            @endif
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        @if (!empty(
                            DB::table('rents')->where('id', $user->current_rent)->value('expiring_date')
                        ) &&
                            DB::table('rents')->where('id', $user->current_rent)->value('expiring_date') < \Carbon\Carbon::now())
                            <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        @elseif (DB::table('rents')->where('id', $user->current_rent)->value('status') == 'Approved')
                            <div
                                class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        @else
                            <div
                                class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
        <div class="card p-3">
            <h6 class="mb-3">Hey {{ Auth::user()->first_name }}!</h6>
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../../assets/img/ivancik.jpg');">
              <span class="mask bg-gradient-dark"></span>
              <div class="card-body position-relative z-index-1 h-100 p-3">
                {{-- <h6 class="text-white font-weight-bolder mb-3">Hey John!</h6> --}}
                @if (\App\Models\BedSpace::where('id', DB::table('rents')->where('id',  Auth::user()->current_rent)->value('bed_space'))->first() && DB::table('rents')->where('id',  Auth::user()->current_rent)->value('status') == 'Approved')
                <p class="mb-3" style="color:white">It is all about who take the opportunity first.</p>
                
                <a class="btn btn-round btn-outline-white mb-0" href="javascript:;" data-toggle="modal"
                data-target="#update-password" >
                  Change Password
                  <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                </a>
                @else
                <p class="text-white mb-3">It is all about who take the opportunity first.</p>
                
                <button class="btn btn-round btn-outline-white mb-0" href="javascript:;"  disabled>
                    Change Password
                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                  </button>
                @endif
              </div>
            </div>
          </div>
    </div>
    <div class="col-12 col-md-6 col-xl-8 mt-md-0 mt-4">
        <div class="card bg-transparent shadow-xl">
            <div class="overflow-hidden position-relative border-radius-xl"
                style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                <span class="mask bg-gradient-dark"></span>
                <div class="card-body position-relative z-index-1">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ $qrcode }}" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                        <div class="col-4">

                            <div class="mb-2">
                                <span
                                    class="text-sm opacity-8 font-weight-bold opacity-8 mb-0"  style="color:white">Name:</span>
                                <span class="font-weight-bold text-sm mb-0" style="color:white">
                                    {{ auth()->user()->first_name }}
                                    {{ auth()->user()->middle_name }}
                                    {{ auth()->user()->last_name }}
                                </span>

                            </div>
                            <div class="mb-2">
                                <span class="text-sm opacity-8 font-weight-bold opacity-8 mb-0"  style="color:white">Email:</span>
                                <span
                                    class=" font-weight-bold text-sm mb-0" style="color:white">{{ auth()->user()->email }}</span>

                            </div>
                            <div class="mb-2">
                                <span class="text-sm opacity-8 font-weight-bold opacity-8 mb-0"  style="color:white">Type:</span>
                                <span class=" font-weight-bold text-sm mb-0" style="color:white">@if (DB::table('bed_spaces')->where('user_id', $user->id)->value('user_id') == $user->id) Resident @else User @endif</span>

                            </div>
                            <div class="mb-2">
                                <span class="text-sm opacity-8 font-weight-bold opacity-8 mb-0"  style="color:white">Student
                                    ID:</span>
                                <span
                                    class=" font-weight-bold text-sm mb-0" style="color:white">{{ auth()->user()->ta_uid ?? auth()->user()->id }}</span>

                            </div>


                        </div>

                    </div>
                    <hr class="horizontal light">
                    <div class="d-flex">
                        <div class="me-4">
                            <p class="text-sm opacity-8 mb-0" style="color:white">Matric</p>
                            <h6 class="mb-0" style="color:white">{{ $user->matric_number }}</h6>
                        </div>
                        <div class="me-4">
                            <p class="text-sm opacity-8 mb-0" style="color:white">Phone</p>
                            <h6 class="mb-0" style="color:white">{{ $user->phone_number }}</h6>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    
  </div>
  <div class="row mt-4">
    <div class="col-sm-8">
      <div class="card">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-6">
              <h6 class="mb-0">Notification</h6>
            </div>
            {{-- <div class="col-md-6 d-flex justify-content-end align-items-center">
              <i class="far fa-calendar-alt me-2" aria-hidden="true"></i>
              <small>23 - 30 March 2021</small>
            </div> --}}
          </div>
        </div>
        <div class="card-body p-3">
            <div class="alert alert-dark alert-dismissible " role="alert" style="color:white">
                Welcome! Here are list of New Notifications
                {{-- <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button> --}}
            </div>
            @if (!empty(DB::table('rents')->where('id', $user->current_rent)->value('school_check_status')) && DB::table('rents')->where('id', $user->current_rent)->value('status') == 'pending')
            <div class="alert alert-warning alert-dismissible" role="alert" style="color:white">
              Your booking is currently on process. if you have a prefered room mate give him/her this code to countinue {{ Auth::user()->verification_code }}.
              <br> Your Room Mate code is {{ Auth::user()->verification_code }}

          </div>
            @if (DB::table('users')->whereNotNull('verification_code')->where('verification_code', DB::table('rents')->where('id', $user->current_rent)->value('room_mate_code'))->where('id', '!=', Auth::id())->first())
            <div class="alert alert-success alert-dismissible" role="alert" style="color:white">
                You have choose to be with  
                {{ DB::table('users')->whereNotNull('verification_code')->where('verification_code', DB::table('rents')->where('id', $user->current_rent)->value('room_mate_code'))->value('first_name') }}
                {{ DB::table('users')->whereNotNull('verification_code')->where('verification_code', DB::table('rents')->where('id', $user->current_rent)->value('room_mate_code'))->value('middle_name') }}
                {{ DB::table('users')->whereNotNull('verification_code')->where('verification_code', DB::table('rents')->where('id', $user->current_rent)->value('room_mate_code'))->value('last_name') }}
                as room mate.
                 @if (DB::table('rents')->where('id', DB::table('users')->whereNotNull('verification_code')->where('verification_code', DB::table('rents')->where('id', $user->current_rent)->value('room_mate_code'))->value('current_rent'))->value('room_mate_code') != $user->verification_code)
                     Waiting for him/her to approve you as a room mate
                 @endif
                
                 

            </div>
            @else
            <div class="alert alert-success alert-dismissible" role="alert" style="color:white">
                 Collect your preferred room mates code and click 
                <a href="javascript:;" class="alert-link " style="color:white" data-toggle="modal"
                data-target="#submit-room-mate-code" >HERE</a> to enter

            </div>
            @endif
            @if (DB::table('rents')->where('id', DB::table('users')->whereNotNull('verification_code')->where('verification_code', DB::table('rents')->where('id', $user->current_rent)->value('room_mate_code'))->value('current_rent'))->value('room_mate_code') == $user->verification_code)
            <div class="alert alert-success alert-dismissible" role="alert" style="color:white">
                {{ DB::table('users')->whereNotNull('verification_code')->where('verification_code', DB::table('rents')->where('id', $user->current_rent)->value('room_mate_code'))->value('first_name') }}
                {{ DB::table('users')->whereNotNull('verification_code')->where('verification_code', DB::table('rents')->where('id', $user->current_rent)->value('room_mate_code'))->value('middle_name') }}
                {{ DB::table('users')->whereNotNull('verification_code')->where('verification_code', DB::table('rents')->where('id', $user->current_rent)->value('room_mate_code'))->value('last_name') }}
                has accepted you as room mate.
            </div>
            @endif
            @endif
        </div>
      </div>
      <div class="card mt-3">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-6">
              <h6 class="mb-0">My Review/Comments</h6>
            </div>
           
          </div>
        </div>
        <div class="card-body py-0 pb-3">
          
          <p class="text-danger @if (Auth::user()->review == null && Auth::user()->rating == null) @else d-none @endif">You have not made any review or comment yet!</p>
          
          
            <div class=" @if (Auth::user()->review != null || Auth::user()->rating != null) @else d-none @endif" id="review-box">
              <form action="/add-review" method="post">
                @csrf
              <label class="mt-4">Star</label>
              <div class="d-flex mb-3">
                <i class="fas fa-star rate @if (Auth::user()->rating >= 1) text-warning @endif" data-value="1"></i>
                <i class="fas fa-star rate @if (Auth::user()->rating >= 2) text-warning @endif" data-value="2"></i>
                <i class="fas fa-star rate @if (Auth::user()->rating >= 3) text-warning @endif" data-value="3"></i>
                <i class="fas fa-star rate @if (Auth::user()->rating >= 4) text-warning @endif" data-value="4"></i>
                <i class="fas fa-star rate @if (Auth::user()->rating >= 5) text-warning @endif me-1" data-value="5"></i>
                <i class="fas fa-times rate text-danger @if (Auth::user()->rating == null) d-none @endif" data-value="0"></i>
              </div>
              <input type="hidden" name="rating" id="rating" value="{{ Auth::user()->rating }}">
           
              <label>Comments</label>
              <textarea class="form-control mb-3" name="review">{{ Auth::user()->review }}</textarea>
              <div class="d-flex mb-3">
                <button type="submit" class="btn btn-round bg-gradient-primary mb-0 me-3" style="color: white;" >
                  Review
                  <i class="fas fa-check text-sm ms-1" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-round bg-gradient-dark mb-0" style="color: white;" id="hide-review-box">
                 Cancel
                  <i class="fas fa-times text-sm ms-1" aria-hidden="true"></i>
                </button>
              </div>
            </form>
            </div>
          
          
          <button type="button" class="btn btn-round bg-gradient-dark mb-0  @if (Auth::user()->review == null && Auth::user()->rating == null) @else d-none @endif" style="color: white;" id="show-review-box">
            Update Review
            <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
          </button>
          
         
        </div>
      </div>
    </div>
    <div class="col-sm-4 mt-sm-0 mt-4">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-6">
              <h6 class="mb-0">Admin Messages</h6>
            </div>
            {{-- <div class="col-md-6 d-flex justify-content-end align-items-center">
              <i class="far fa-calendar-alt me-2" aria-hidden="true"></i>
              <small>01 - 07 June 2021</small>
            </div> --}}
          </div>
        </div>
        <div class="card-body py-0">
            <ul class="list-group">
                @foreach (DB::table('messages')->where('user_id', Auth::user()->id)->where('status', 'quick_message')->orWhere('user_id', 'all')->where('status', 'quick_message')->orderBy('id', 'DESC')->limit(5)->get() as $message)
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-0 border-radius-lg">
                        <div class="d-flex flex-column">

                          
                            <span class="text-sm"></span><span class="text-xs">{{ $message->message }}</span>
                            <span
                            class="text-xxs text-success">{{ $message->created_at }}</span>
                        </div>
                    </li>
                    {{-- <hr> --}}
                @endforeach



            </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-sm-6">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-6">
              <h6 class="mb-0">Your Transaction's</h6>
            </div>
            {{-- <div class="col-md-6 d-flex justify-content-end align-items-center">
              <i class="far fa-calendar-alt me-2" aria-hidden="true"></i>
              <small>23 - 30 March 2021</small>
            </div> --}}
          </div>
        </div>
        <div class="card-body p-3">
            <ul class="list-group">
              @foreach (\App\Models\BedSpace::where('user_id', Auth::user()->id)->get() as $rent)
              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                 {{-- <div class="d-flex flex-column m-3"
                    style="background-image: url('{{ asset('/photo/' . $rent->room->photo) }}');">
                    <img src="{{ asset($rent->room->photo) }}" alt="" srcset="" height="100"
                        width="120">
                </div> --}}
                <div class="d-flex flex-column">
                  <h6 class="mb-3 text-sm text-bold"> {{ auth()->user()->first_name }}
                    {{ auth()->user()->middle_name }}
                    {{ auth()->user()->last_name }} 
                    @if (DB::table('rents')->where('bed_space', $rent->id)->value('status') == 'Approved')
                    <span class="mb-2 text-xs text-success">{{DB::table('rents')->where('bed_space', $rent->id)->value('status') }} </span>
                    @else
                    <span class="mb-2 text-xs text-warning">Pending </span>
                    
                    @endif
                  </h6>
                  <span class="mb-2 text-xs">Email Address: <span class="text-dark font-weight-bold ms-sm-2">{{ Auth::user()->email }}</span></span>
                  <span class="mb-2 text-xs">Phone Number: <span class="text-dark ms-sm-2 font-weight-bold">{{ Auth::user()->phone_number }}</span></span>
                  <span class="mb-2 text-xs">Room Type: <span class="text-dark ms-sm-2 font-weight-bold">{{ $rent->room->name }}</span></span>
                  <span class="text-xs">Transaction ID: <span class="text-dark ms-sm-2 font-weight-bold">{{DB::table('rents')->where('bed_space', $rent->id)->value('payment_reference') }}</span></span>
                   </div>
                <div class="ms-auto text-end">
                  <a class="btn btn-link text-dark px-3 mb-0" href="/invoice/{{DB::table('rents')->where('bed_space', $rent->id)->value('payment_reference') }}"><i class="fas fa-file-pdf text-dark me-2" aria-hidden="true"></i>Invoice</a>
                </div>
              </li>
                              
                @endforeach

            </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-6 mt-sm-0 mt-4">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-6">
              <h6 class="mb-0">Invoices</h6>
            </div>
            {{-- <div class="col-md-6 d-flex justify-content-end align-items-center">
              <i class="far fa-calendar-alt me-2" aria-hidden="true"></i>
              <small>01 - 07 June 2021</small>
            </div> --}}
          </div>
        </div>
        <div class="card-body p-3">
          <ul class="list-group">
            @foreach (DB::table('invoices')->where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(10)->get()
            as $invoice)
            <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
              <div class="d-flex">
                <div class="d-flex align-items-center">
                    @if ($invoice->status != 'successful')
                    <a href="/invoice/{{ $invoice->application_no }}" class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down" aria-hidden="true"></i></a href="/invoice/">
                                    @else
                                    <a href="/invoice/{{ $invoice->application_no }}" class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up" aria-hidden="true"></i></a href="/invoice/">
                                    @endif
                  
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">{{ $invoice->payment_method }}</h6>
                    <span class="text-xs"> payment for {{ $invoice->type }} - {{ Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}</span>
                  </div>
                </div>
                @if ($invoice->status != 'successful')
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                    {{ $invoice->amount }}
                </div>
                 @else
                 <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                    ₦ {{ $invoice->amount }}
                </div>
                @endif
                
              </div>
              <hr class="horizontal dark mt-3 mb-2">
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  @if (DB::table('users')->where('id', Auth::user()->id)->value('disable_picture_update') == false)
                            
  <div class="modal fade" id="update-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update</h4>

            </div>
            <form class="form-horizontal" method="POST" action="{{ route('profile.updatepersonalinfo') }}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-body">



                    <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                        <label for="photo" class="col-md-12 control-label">Profile Photo</label>

                        <div class="col-md-12">
                            <input required class="form-input ms-auto form-control" placeholder="500" type="file"
                                name="photo" id="">

                            @if ($errors->has('photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>



                </div>
                <div class="modal-footer justify-content-between">

                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-4">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endif
<div class="modal fade" id="update-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Password</h4>

            </div>
            <div class="card-body p-3">
                <form class="form-horizontal" method="POST"
                                action="{{ route('profile.updatePassword') }}">
                                {{ csrf_field() }}
                <label class="form-label">Current password</label>
                <div class="form-group">
                    <input id="currentPassword" type="password" class="form-control"
                    name="currentPassword" placeholder="Current password" required>

                @if ($errors->has('currentPassword'))
                    <span class="help-block">
                        <strong>{{ $errors->first('currentPassword') }}</strong>
                    </span>
                @endif
                </div>
                <label class="form-label">New password</label>
                <div class="form-group">
                    <input id="newPassword" type="password" class="form-control" name="newPassword"
                    placeholder="New password" required>

                @if ($errors->has('newPassword'))
                    <span class="help-block">
                        <strong>{{ $errors->first('newPassword') }}</strong>
                    </span>
                @endif
                </div>
                <label class="form-label">Confirm new password</label>
                <div class="form-group">
                    <input id="newPasswordConfirm" type="password" class="form-control"
                    name="newPassword_confirmation" placeholder="Enter password" required>
                </div>
                <button class="btn bg-gradient-dark w-100 mb-0">Update password</button>
            </form>
              </div>
            
                                
                            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="services">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Our Services</h4>
              <button type="button" class="btn-close text-dark" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="card-body text-center p-3">
            @foreach (DB::table('products')->limit(4)->get() as $product)
            <div class="col-12 mt-4 mt-lg-0 mb-3">
                <div class="card">
                  <div class="card-header p-3 pb-0">
                    <div class="row">
                      <div class="col-8 d-flex">
                        <div>
                          <img src="{{ $product->photo }}" class="avatar avatar-sm me-2" alt="avatar image">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6>{{ $product->name }} @if (count(explode(',', $product->price)) > 1) (Multi-price) @endif</h6>
                          <p class="text-sm">{{ $product->description }}</p>
                        </div>
                      </div>
                      <div class="col-4">
                          @if (\Carbon\Carbon::parse($product->updated_at) >= \Carbon\Carbon::now()->subDays(7))
                          <span class="badge bg-gradient-info ms-auto float-end">New</span>
                          @endif
                        
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-3 pt-1">
                    
                    <form action="/create_product_invoice/{{$product->uid}}" method="post">
                        @csrf
                    <div class="d-flex bg-gray-100 border-radius-lg p-3">
                      <h4 class="my-auto d-inline-flex">
                        @if (count(explode(',', $product->price)) > 1)
                            <span class="text-secondary text-sm me-1">N</span> 
                            <select name="price" class="form-control room h4 bg-gray-100 m-0 py-1" style="border: 0px;" name="room" id="room" name="room" required oninvalid="this.setCustomValidity('Click here to select price from dropdown')" oninput="setCustomValidity('')">
                                <option value="">select</option>
                                @foreach (explode(',', $product->price) as $price)
                                <option value="{{ $price }}">{{ number_format($price) }}</option>
                                @endforeach
                            </select>
                        @else
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <span class="text-secondary text-sm me-1">N</span>{{ number_format($product->price) }}<span class="text-secondary text-sm ms-1"></span>
        
                        @endif
                        </h4>
                      {{-- @if (DB::table('purchased_services')->where('user_id', Auth::user()->id)->where('service_uid', $product->uid)->value('status') == 'purchased')
                      <a href="#" class="btn btn-dark mb-0 ms-auto">Purchased</a>
                      @elseif(DB::table('purchased_services')->where('user_id', Auth::user()->id)->where('service_uid', $product->uid)->value('status') == 'waiting')
                      <a href="/services/purchase/__product/{{DB::table('purchased_services')->where('user_id', Auth::user()->id)->where('service_uid', $product->uid)->value('service_uid')}}/invoice/{{DB::table('purchased_services')->where('user_id', Auth::user()->id)->where('service_uid', $product->uid)->value('application_no')}}" class="btn btn-outline-dark mb-0 ms-auto">Continue Purchase</a>
                      @else --}}
                      <button type="submit" class="btn btn-outline-dark mb-0 ms-auto">Purchase</button>
                      
                      {{-- @endif --}}
                      
                    </div>
                </form>
                  </div>
                </div>
              </div>
            @endforeach
            </div>
          
            <div class="text-center">
              <a href="/services" class="mt-3 mb-3 btn btn-dark mb-0 ms-auto">View More</a>
            </div>
                                    
                          
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="submit-room-mate-code">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Password</h4>

            </div>
            <div class="card-body p-3">
                <form class="form-horizontal" method="POST"
                                action="/room-mate-code">
                                {{ csrf_field() }}
                                <p class="text-center">input the code given to by your prefered rom mate</p>
                <label class="form-label">Code </label>
                <div class="form-group">
                    <input id="room_mate_code" type="text" class="form-control"
                    name="verification_code" placeholder="Room mate code" required>

                @if ($errors->has('room_mate_code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('room_mate_code') }}</strong>
                    </span>
                @endif
                
                <button class="btn bg-gradient-dark w-100 mb-0 mt-3">Submit</button>
            </form>
              </div>
            
                                
                            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@section('script')
@if (session('new_login') == 'YES' && DB::table('rents')->where('user_id', auth()->user()->id)->value('updated_at') > \Carbon\Carbon::now()->subDays(7) && auth()->user()->role == 'student')
  {{-- <script>
    
    window.location.href = "{{ url('/services') }}";
  </script> --}}

  <script>
    $(document).ready(function(){
     $("#services").modal();
      });
    </script>
@endif

<script src="{{ asset('/assets/js/plugins/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();

            $(document).on('click', '#show-review-box', function(e){
              e.preventDefault
              $('#review-box').removeClass('d-none');
              $(this).addClass('d-none');
            });

            $(document).on('click', '#hide-review-box', function(){
              $('#review-box').addClass('d-none');
              $('#show-review-box').removeClass('d-none');
            });

            $(document).on('click', '.rate', function(){
              var clicked = $(this).data('value');
          
              if(clicked == 0){
                $('#rating').val('');
                $('.rate').each(function(){
                var value = $(this).data('value')
                $(this).removeClass('text-warning');
                if(value == 0){
                  $(this).addClass('d-none');
                }
              
              })
              }else{
                $('.rate').each(function(){
              var value = $(this).data('value')
              
                if(value <= clicked){
                  $(this).addClass('text-warning');
                }else if(value > clicked){
                  $(this).removeClass('text-warning');
                }
                if(value == 0){
                  $(this).removeClass('d-none');
                }
               
              })
              $('#rating').val(clicked);
              }
              
              
            });
        });

        

    </script>
@endsection
