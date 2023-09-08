<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Talents Apartment
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">

  <!-- End Navbar -->
  <section class="min-vh-90 mb-8">
    
    <div class="container">

    <div class="row mt-10">
        <div class="col-12">
            <div class="row">

                <div class="col-lg-3">
                    <div class="card">

                        <div class="card-body ">
                            <div class="text-center">
                                <div class="" data-toggle="modal" data-target="#update-profile" data-trigger="hover"
                                    data-toggle="popover" title="Change" data-content="Click to change profile picture">
                                    <img src="{{ $user->photo ?? '../assets/img/no-image.png' }}" style="width: 100px;"
                                        alt="profile_image" class=" border-radius-lg shadow-sm">
                                </div>
                                <hr class="horizontal  dark">
                                
                            </div>




                        </div>
                    </div>


                    <div class="card my-3">
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


                </div>
                <div class="col-lg-7 mb-2">
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
                                                class="text-sm text-white opacity-8 font-weight-bold opacity-8 mb-0">Name:</span>
                                            <span class=" font-weight-bold text-sm text-white mb-0">
                                                {{ $user->first_name }}
                                                {{ $user->middle_name }}
                                                {{ $user->last_name }}
                                            </span>

                                        </div>
                                        <div class="mb-2">
                                            <span class="text-sm text-white opacity-8 font-weight-bold mb-0">Email:</span>
                                            <span
                                                class=" font-weight-bold text-sm text-white mb-0">{{ $user->email }}</span>

                                        </div>
                                        <div class="mb-2">
                                            <span class="text-sm text-white opacity-8 font-weight-bold mb-0">Type:</span>
                                            <span class=" font-weight-bold text-sm text-white mb-0">@if (DB::table('bed_spaces')->where('user_id', $user->id)->value('user_id') == $user->id) Resident @else User @endif</span>

                                        </div>
                                        <div class="mb-2">
                                            <span class="text-sm text-white opacity-8 font-weight-bold mb-0">Student
                                                ID:</span>
                                            <span
                                                class=" font-weight-bold text-sm text-white mb-0">{{ $user->ta_uid ?? $user->id }}</span>

                                        </div>


                                    </div>

                                </div>
                                <hr class="horizontal light">
                                <div class="d-flex">
                                    <div class="me-4">
                                        <p class="text-white text-sm opacity-8 mb-0">Matric</p>
                                        <h6 class="text-white mb-0">{{ $user->matric_number }}</h6>
                                    </div>
                                    <div class="me-4">
                                        <p class="text-white text-sm opacity-8 mb-0">Phone</p>
                                        <h6 class="text-white mb-0">{{ $user->phone_number }}</h6>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-2 mb-4">
                    <div class="card bg-gradient-primary h-100">
                        <div class="card-body text-center">
                            <div class="d-flex mb-4 text-white">
                               TALENTs
                               <br>
                               Appartment
                            </div>
                            <svg width="45px" viewBox="0 0 41 31" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>Status</title>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="wifi" transform="translate(3.000000, 3.000000)">
                                        <path
                                            d="M7.37102658,14.6156105 C12.9664408,9.02476091 22.0335592,9.02476091 27.6289734,14.6156105"
                                            stroke="#FFFFFF" stroke-width="5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <circle fill="#FFFFFF" cx="17.5039082" cy="22.7484921" r="4.9082855"></circle>
                                        <path
                                            d="M0,7.24718945 C9.66583791,-2.41572982 25.3341621,-2.41572982 35,7.24718945"
                                            stroke="#FFFFFF" stroke-width="5" opacity="0.398982558"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg>
                            <p class="font-weight-bold mt-4 mb-0 text-white">Status</p>
                            <span class="text-xs text-white">Online</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- <div class="col-lg-3 mb-4">
            
        </div> --}}
        
    </div>
</section>
<!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
<footer class="footer py-5">
  <div class="container">
    <div class="row">

    </div>
    <div class="row">
      <div class="col-8 mx-auto text-center mt-1">
        <p class="mb-0 text-secondary">
          Copyright © <script>
            document.write(new Date().getFullYear())
          </script> Talents Apartment
        </p>
      </div>
    </div>
  </div>
</footer>
<!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
<script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>
