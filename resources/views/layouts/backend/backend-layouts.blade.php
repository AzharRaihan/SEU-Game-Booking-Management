<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <!-- App title -->
        <title>Games Room</title>
        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
        <!-- Bootstrap CSS -->
        <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Yield Css -->
        @stack('page-css')
        <!-- App CSS -->
        <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet" type="text/css" />
        <!-- IziToast Css -->
        <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
    </head>
    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            @include('errors.message')
            <!-- Top Bar Start -->
            @include('layouts.backend.partials.header')
            <!-- Top Bar End -->
            <!-- Left Sidebar Start -->
            @include('layouts.backend.partials.sidebar')
            <!-- Left Sidebar End -->
            <!-- Start right Content here -->
            <div class="content-page">
                @yield('page-content')
            </div>
            <!-- End content-page -->
            <!-- Footer -->
            <footer class="footer">
                2016 - 2019 © Uplon.
            </footer>
            <!-- Footer End -->
        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>
        <!-- Modernizr js -->
        <script src="{{ asset('assets/backend/js/modernizr.min.js') }}"></script>
        <!-- jQuery  -->
        <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/backend/js/waves.js') }}"></script>
        <!-- Counter Up  -->
        <script src="{{ asset('assets/backend/plugins/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/backend/plugins/counterup/jquery.counterup.js') }}"></script>
        <!-- Page specific js -->
        <script src="{{ asset('assets/backend/pages/jquery.dashboard.js') }}"></script>
        <!-- Yield Js -->
        @stack('page-js')
        <!-- IziToast Js -->
        <script src="{{ asset('js/iziToast.js') }}"></script>
        @include('vendor.lara-izitoast.toast')
        <!-- App js -->
        <script src="{{ asset('assets/backend/js/jquery.core.js') }}"></script>
        <script src="{{ asset('assets/backend/js/jquery.app.js') }}"></script>
    </body>
</html>