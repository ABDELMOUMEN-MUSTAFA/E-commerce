<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
        
        <!-- App css -->
        <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Pre-loader -->
        <div id="preloader">
            <div id="status">
                <div class="bouncing-loader"><div></div><div></div><div></div></div>
            </div>
        </div>
        <!-- End Preloader-->
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                @yield('content')
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            2023 - 2024 © shopfromme.tech
        </footer>

        <!-- bundle -->
        <script src="{{ asset('js/vendor.min.js') }}"></script>
        <script src="{{ asset('js/app.min.js') }}"></script>
        
        @yield('scripts', '')
    </body>
</html>

