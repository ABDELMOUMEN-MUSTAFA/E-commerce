<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'SHOP FROM ME')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- All CSS is here
	============================================ -->

    <!-- <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/signericafat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/cerebrisans.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/elegant.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/linear-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/easyzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/vendor/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    @yield('styles', '')
</head>

<body>
    <div class="main-wrapper">
        @include('includes.customer.navbar')
        @include('includes.customer.miniShoppingCart')
        @include('includes.customer.mobileMenu')
        @yield('content', '')
    </div>

    <!-- All JS is here
============================================ -->

    <script src="{{ asset('js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/plugins/slick.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/plugins/wow.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-ui-touch-punch.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('js/plugins/sticky-sidebar.js') }}"></script>
    <script src="{{ asset('js/plugins/easyzoom.js') }}"></script>
    <script src="{{ asset('js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('js/plugins/ajax-mail.js') }}"></script>

    <!-- Use the minified version files listed below for better performance and remove the files listed above  
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>  -->
    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts', '')
</body>

</html>