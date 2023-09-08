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
    <meta name="keywords" content="Affordable international student housing in Ibadan, UI student accommodation for international students, On-campus housing for international students in UI Agbowo, UI University of Ibadan international student housing options, University of Ibadan student housing for international postgraduates, International student accommodation near UI, University of Ibadan off-campus housing for international students, UI accommodation for international undergraduate students, UI student accommodation with cultural programs, UI student housing with language support, UI student accommodation with international student community, UI student housing with academic support for international students, UI student accommodation with airport pickup, UI student housing with study abroad programs, UI student accommodation with international student orientation, UI student housing with cultural exchange programs, UI student accommodation with international student events, UI student housing with international student resources, UI student housing with international student organizations, UI student housing with social activities for international students, On-campus student housing in UI, UI undergraduate student accommodation, UI postgraduate student accommodation, UI student hostel rooms, Affordable UI student accommodation, UI student accommodation with meal plans, UI student accommodation with study areas, UI student accommodation with social spaces, UI student accommodation with 24/7 security, UI student accommodation with en-suite bathrooms, University of Ibadan student accommodation for international students, UI student accommodation with on-site laundry facilities, UI student accommodation with parking, UI student accommodation with air conditioning, UI student accommodation with accessible features, UI student accommodation for medical students, UI student accommodation for law students, UI student accommodation for engineering students, UI student accommodation for business students, Comfortable and spacious student housing near UI, Budget-friendly student accommodation in Ibadan, All-female student accommodation in Ibadan, All-male student accommodation in Ibadan, Walking distance to UI campus student housing Agbowo, Student accommodation with study areas and libraries University of Ibadan, Pet-friendly student accommodation in Ibadan University of Ibadan, Student accommodation with sports facilities, All-inclusive student housing in Ibadan, Shared student apartments in Ibadan, Single occupancy student housing in Ibadan, Newly built student accommodation in Ibadan, Fully equipped kitchens in student accommodation, Student accommodation with 24/7 security, UI international student accommodation in Ibadan, Affordable off-campus housing for UI students, Student accommodation with laundry facilities, UI medical student accommodation in Ibadan, UI law student accommodation in Ibadan, UI engineering student accommodation in Ibadan, UI student accommodation, Student hostels in Ibadan, Off-campus accommodation for UI students, Affordable student apartments near UI, Best student housing in Ibadan, Student accommodation with free WiFi, Furnished apartments for UI students, Safe and secure student housing in Ibadan, Convenient off-campus accommodation for UI students, UI student accommodation with flexible lease options, Student accommodation with all-inclusive amenities, Private rooms for UI students in Ibadan, On-campus alternative student housing, UI postgraduate student accommodation, Short-term student accommodation in Ibadan, UI serviced student apartments, Short-term student housing in Ibadan, UI fully furnished student accommodation, Flexible lease UI student housing, Short-term UI student housing with utilities included, UI short-term student accommodation with cleaning service, UI serviced student housing with WiFi, Affordable short-term student accommodation near UI, UI serviced student housing with on-site parking, UI short-term student accommodation with kitchenette, UI serviced student accommodation with laundry facilities, UI short-term student accommodation with 24/7 security, All-inclusive short-term student housing near UI, UI short-term student accommodation with shared spaces, UI serviced student housing with proximity to campus, Short-term UI student accommodation with social events, UI serviced student accommodation with fitness center, UI short-term student housing with study areas, Private short-term student apartments in Ibadan, UI short-term student accommodation with shuttle service, Private Accommodation On and Off Campus" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        @yield('page-title') - Talents Apartment
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    {{-- <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/fontawesome-free/css/all.min.css') }}" crossorigin="anonymous"/> --}}
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/datatable.css') }}" rel="stylesheet" />

    {{-- <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.min.css?v=1.0.9" rel="stylesheet" /> --}}
    <script src="../assets/js/sweetalert.min.js"></script>
    <link href="{{ asset('assets/js/fontawesome-kit.js') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/js/plugins/fontawesome-free/css/all.min.css') }}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('/assets/css/daterangepicker.css') }}" />


    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <script src="{{ asset('/assets/js/plugins/sweetalert.min.js') }}"></script>
    <style>
      .btn {
    margin-bottom: 0rem;
    letter-spacing: -0.025rem;
    text-transform: uppercase;
    box-shadow: 0 4px 7px -1px rgb(0 0 0 / 11%), 0 2px 4px -1px rgb(0 0 0 / 7%);
    background-size: 150%;
    background-position-x: 25%;
}

.input-group-prepend {
    margin-right: -1px;
}
.input-group-append, .input-group-prepend {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
}
*, ::after, ::before {
    box-sizing: border-box;
}
        .h-divider {
  margin: auto;
  /* margin-top: 80px; */
  /* width: 80%; */
  position: relative;
}

.h-divider .shadow {
  overflow: hidden;
  height: 20px;
}

.h-divider .shadow:after {
  content: '';
  display: block;
  margin: -25px auto 0;
  width: 100%;
  height: 25px;
  border-radius: 125px/12px;
  box-shadow: 0 0 8px black;
}

.h-divider .text {
  width: 100px;
  height: 45px;
  padding: 10px;
  position: absolute;
  bottom: 100%;
  margin-bottom: -16px;
  left: 50%;
  margin-left: -60px;
  border-radius: 80px;
  box-shadow: 0 0 8px black;
  /* background: white; */
}

    </style>
    @yield('style')
    <style>
      .hidden {
        display: none;
      }
        #ofBar {
          background: #fff;
          z-index: 999999999;
          font-size: 16px;
          color: #333;
          padding: 16px 40px;
          font-weight: 400;
          display: flex;
          justify-content: space-between;
          align-items: center;
          position: fixed;
          top: 40px;
          width: 80%;
          border-radius: 8px;
          left: 0;
          right: 0;
          margin-left: auto;
          margin-right: auto;
          box-shadow: 0 13px 27px -5px rgba(50,50,93,0.25), 0 8px 16px -8px rgba(0,0,0,0.3), 0 -6px 16px -6px rgba(0,0,0,0.025);
        }
      
        #ofBar-logo img {
          height: 50px;
        }
      
        #ofBar-content {
          display: inline;
          padding: 0 15px;
        }
      
        #ofBar-right {
          display: flex;
          align-items: center;
        }
      
        #ofBar b {
          font-size: 15px !important;
        }
        #count-down {
          display: initial;
          padding-left: 10px;
          font-weight: bold;
          font-size: 20px;
        }
        #close-bar {
          font-size: 17px;
          opacity: 0.5;
          cursor: pointer;
        }
        #close-bar:hover{
          opacity: 1;
        }
        #btn-bar {
          background-image: linear-gradient(310deg, #141727 0%, #3A416F 100%);
          color: #fff;
          border-radius: 4px;
          padding: 10px 20px;
          font-weight: bold;
          text-transform: uppercase;
          text-align: center;
          font-size: 12px;
          opacity: .95;
          margin-right: 20px;
          box-shadow: 0 5px 10px -3px rgba(0,0,0,.23), 0 6px 10px -5px rgba(0,0,0,.25);
        }
         #btn-bar, #btn-bar:hover, #btn-bar:focus, #btn-bar:active {
           text-decoration: none !important;
           color: #fff !important;
       }
        #btn-bar:hover{
          opacity: 1;
        }
      
        #btn-bar span, #ofBar-content span {
          color: red;
          font-weight: 700;
        }
      
        #oldPriceBar {
          text-decoration: line-through;
          font-size: 16px;
          color: #fff;
          font-weight: 400;
          top: 2px;
          position: relative;
        }
        #newPrice{
          color: #fff;
          font-size: 19px;
          font-weight: 700;
          top: 2px;
          position: relative;
          margin-left: 7px;
        }
      
        #fromText {
          font-size: 15px;
          color: #fff;
          font-weight: 400;
          margin-right: 3px;
          top: 0px;
          position: relative;
        }
      
        @media(max-width: 991px){
      
        }
        @media (max-width: 768px) {
          #count-down {
            display: block;
            margin-top: 15px;
          }
      
          #ofBar {
            flex-direction: column;
            align-items: normal;
          }
      
          #ofBar-content {
            margin: 15px 0;
            text-align: center;
            font-size: 18px;
          }
      
          #ofBar-right {
            justify-content: flex-end;
          }
        }
      </style>
      
        <style>
          .navbar-vertical .navbar-brand>img, .navbar-vertical .navbar-brand-img {
      max-width: 100%;
      max-height: 10rem;
  }
  .text-gradient.text-own {
      /* background-image: linear-gradient(310deg, #7928CA, #FF0080); */
      background-image: linear-gradient(310deg, #d40000 0%, #2152ff 100%)
  }
      </style>
     
     @yield('styles')
        {{-- @vite(['resources/js/app.js', 'resources/js/vendor/webauthn/webauthn.js']) --}}
 
</head>

<div class="d-none">
  

    @if ($message = session('success'))
        {{ $message }}
        <script>
            //  Swal.fire('Success!', '{{ $message }}', 'success' );
            Swal.fire("Success", "{{ $message }}", "success");
        </script>
    @endif


    @if ($message = session('error'))
        {{ $message }}
        <script>
            Swal.fire("Error", "{{ $message }}", "error");
        </script>
    @endif


    @if ($message = session('warning'))
        {{ $message }}
        <script>
            Swal.fire("Warning", "{{ $message }}", "warning");
        </script>
    @endif


    @if ($message = session('info'))
        {{ $message }}
        <script>
            Swal.fire("Info", "{{ $message }}", "info");
        </script>
    @endif

    
    @if (session('new_login') == 'YES' && DB::table('rents')->where('user_id', auth()->user()->id)->value('updated_at') > \Carbon\Carbon::now()->subDays(7) && auth()->user()->role == 'student')
    <script>
      $(document).ready(function(){
       $("#services").modal();
        });
      </script> 
@endif


    
</div>

<body class="g-sidenav-show  bg-gray-100">
    
    @if (Auth::user()->role == 'student')
    <div id="ofBar" style="display:none"><div id="ofBar-logo"> <img alt="" src="/logo.jpg"></div><div id="ofBar-content">{!! html_entity_decode(DB::table('ofbar')->value('content')) !!}</div> <div id="ofBar-right">@if (DB::table('ofbar')->value('button') == true)<a href="{{ DB::table('ofbar')->value('button_url') }}" target="_blank" id="btn-bar">{{ DB::table('ofbar')->value('button_text') }}</a>@endif<a id="close-bar">×</a></div></div>
    
    
    @endif
    @if (Auth::user()->role == 'student') 
        @include('layouts.profile_nav_menu')
    @elseif (Auth::user()->role == 'super_admin' && !request()->is('guest/code-page')) 
        @include('layouts.super_admin_nav_menu')
    @elseif (Auth::user()->role == 'staff' && !request()->is('guest/code-page')) 
        @include('layouts.staff_nav_menu')
    @elseif (Auth::user()->role == 'lawyer' && !request()->is('guest/code-page')) 
        @include('layouts.lawyer_nav_menu')
    @elseif (Auth::user()->role == 'complaints_manager' && !request()->is('guest/code-page'))
        @include('layouts.compain_manager_nav_menu' && !request()->is('guest/code-page'))
    @elseif (Auth::user()->role == 'admin' && !request()->is('guest/code-page'))
        @include('layouts.admin_nav_menu')
    @elseif (Auth::user()->role == 'accountant' && !request()->is('guest/code-page'))
        @include('layouts.accountant_nav_menu')
    @endif
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <!-- Navbar -->
        @include('layouts.mobile_nav')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <!-- Page -->

            @yield('content')
            {{-- <button class="btn bg-gradient-primary mb-0" onclick="soft.showSwal('custom-html')">Try me!</button> --}}
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

    <script src="{{ asset('assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
   
    <script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr.min.js') }}"></script>
    <!-- Kanban scripts -->
    <script src="{{ asset('assets/js/plugins/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jkanban/jkanban.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert.min.js') }}"></script>

    {{-- <script src="{{ asset('/assets/js/plugins/datatables/datatables.min.js') }}"></script> --}}
    <script src="{{ asset('/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>

    <script src="{{ asset('/assets/js/plugins/datatables.js') }}"></script>
    

    @yield('script')
    <script>
        (function($) {
          $('[data-toggle="tooltip"]').tooltip();

            //Regiser BS PopOver
            $('[data-toggle="popover"]').popover();

            //   'use strict'

            // var saveMode = localStorage.getItem("mode");





            // $('#dark-mode-button').on('load', function() {

            //     var defaultMode = localStorage.getItem("mode");
            //     if (defaultMode == 'dark-version') {
            //         alert('yes');
            //         loadLightMode()
            //     } else {
            //         alert('no')
            //         loadDarkMode()
            //     }

            // })

            $('#dark-mode-button').on('click', function() {


                // if ($(this).data('mode') == 'dark') 
                if ($('body').hasClass('dark-version')) {

                    loadLightMode()
                    localStorage.setItem("mode", "light-version");

                } else {

                    loadDarkMode()
                    localStorage.setItem("mode", "dark-version");

                }
            })
            $('#notificationMenuButton').on('click', function() {


// alert('ehbyfby')
$.ajax({
                        url: "/change_notification_status",
                        method: "GET",
                        // data: {
                        //     room_id: room_id,
                        //     user_id: user_id,
                        //     room_number: room_number,
                        // },
                        dataType: 'JSON',
                        beforeSend(xhr) {},
                        complete(xhr) {},
                        success: function(data) {

                            if (data.status == 'success') {
                                // alert(JSON.stringify(data))





                            }
                        },
                        error: function(xhr) {}
                    });
})






        })(jQuery)
    </script>
<script type="text/javascript" id="">
// var a = 'view_offer_bar';
// var d = 'true';
// var c = 1;

// var b = new Date();
// b.setTime(b.getTime()+864E5*c);
// c="expires="+b.toUTCString();
// alert(a+"="+d+";"+c+";path=/");

// alert(readCookie('view_offer_barr'))

function setCookie(a,d,c){
    var b = new Date();
    b.setTime(b.getTime()+864E5*c);
    c="expires="+b.toUTCString();
    document.cookie=a+"="+d+";"+c+";path=/"
}

function readCookie(a){
    a += "=";
    for(var d=document.cookie.split(";"), c=0; c<d.length; c++){
            for(var b=d[c];" "==b.charAt(0);)
            b = b.substring(1,b.length);
            if(0==b.indexOf(a))
            return b.substring(a.length,b.length)
        }
        return null
}

//     function getCookie(cname) {
//   var name = cname + "=";
//   var decodedCookie = decodeURIComponent(document.cookie);
//   var ca = decodedCookie.split(';');
//   for(var i = 0; i <ca.length; i++) {
//     var c = ca[i];
//     while (c.charAt(0) == ' ') {
//       c = c.substring(1);
//     }
//     if (c.indexOf(name) == 0) {
//       return c.substring(name.length, c.length);
//     }
//   }
//   return "";
// }


// alert(getCookie('view_offer_bart'))

    function createOfferBar(){
        // var a=document.createElement("div");
        // a.setAttribute("id","ofBar");
        // a.innerHTML="<div id='ofBar-logo'> <img alt='creative-tim-logo' src='https://s3.amazonaws.com/creativetim_bucket/static-assets/logo.png'></div><div id='ofBar-content'> <b>10+ Summer Specials</b> for Web Developers and UI/UX Designers. Take advantage now! \u23f0</div><div id='ofBar-right'><a href='https://www.creative-tim.com/campaign?ref=demos-win-2021' target='_blank' id='btn-bar'>View Offers</a><a id='close-bar'>\u00d7</a></div>";
        // document.body.insertBefore(a,document.body.firstChild)
        document.getElementById("ofBar").setAttribute("style", "display:t");
    }
    
    function closeOfferBar(){
       
        document.getElementById("ofBar").setAttribute("style", "display:none");
        setCookie("view_offer_bar","true",1)
    }

    

    var value = readCookie("view_offer_ba");
    if(readCookie("view_offer_bar") == null){
        // alert('value')
        createOfferBar();
        document.getElementById("close-bar").addEventListener("click", closeOfferBar);
    }
   
   
</script>
    <script>
      
        var url = window.location;
 
        // for sidebar menu entirely but not cover treeview
        $('ul.navbar-nav a').filter(function() {
            return this.href == url;
        }).addClass('active');
        // for treeview
        $('ul.nav a').filter(function() {
            return this.href == url;
        }).parentsUntil(".navbar-nav > .nav").addClass('show').prev('a').addClass('active');
    </script>


    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/soft-ui-dashboard.js?v=1.0.3') }}"></script>
    <script src="{{ asset('assets/js/dark-light-mode.js') }}"></script>
    
</body>

</html>
