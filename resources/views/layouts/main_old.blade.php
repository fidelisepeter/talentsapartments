<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        @yield('page-title') - Talents Apartment
    </title>
    <!--     Fonts and icons     -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> --}}
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- <script src="{{ asset('assets/fontawesome-free/css/all.min.css') }}" crossorigin="anonymous"></script> -->
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/datatable.css') }}" rel="stylesheet" />
    
{{-- <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.min.css?v=1.0.9" rel="stylesheet" /> --}}
    <script src="../assets/js/sweetalert.min.js"></script>
    {{-- <link href="{{ asset('assets/js/fontawesome-kit.js') }}" rel="stylesheet" /> --}}
    
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <style>
        .btn {
   
    padding: 0.35rem 0.90rem;
    
}
    </style>
</head>
<div class="d-none">
    @if ($message = session('success'))
        {{ $message }}
        <script>
            swal("Success", "{{ $message }}", "success");
        </script>
    @endif


    @if ($message = session('error'))
        {{ $message }}
        <script>
            swal("Error", "{{ $message }}", "error");
        </script>
    @endif


    @if ($message = session('warning'))
        {{ $message }}
        <script>
            swal("Warning", "{{ $message }}", "warning");
        </script>
    @endif


    @if ($message = session('info'))
        {{ $message }}
        <script>
            swal("Info", "{{ $message }}", "info");
        </script>
    @endif
</div>

<body class="g-sidenav-show  bg-gray-100">


    @if (Auth::user()->role == 'student')
        @include('layouts.profile_nav_menu')
    @elseif (Auth::user()->role == 'super_admin')
        @include('layouts.super_admin_nav_menu')  
    @elseif (Auth::user()->role == 'complaints_manager')
        @include('layouts.compain_manager_nav_menu')
    @elseif (Auth::user()->role == 'admin')
        @include('layouts.admin_nav_menu')
    @elseif (Auth::user()->role == 'accountant')
        @include('layouts.accountant_nav_menu')   
    
    @endif



    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <!-- Navbar -->
        @include('layouts.mobile_nav')
        <!-- End Navbar -->
        <div class="container-fluid py-4">



            <!-- Page -->
            @yield('content')
            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i>

                            </div>
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
<script src="{{ asset('/assets/js/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

@yield('script')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
   
    <script>
        /** add active class and stay opened when selected */
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
    <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
    
</body>

</html>
