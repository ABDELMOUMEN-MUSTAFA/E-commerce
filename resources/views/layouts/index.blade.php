<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')</title>
    @yield('meta_csrf')
	<!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Datatables css -->
    <link href="{{ asset('css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">
</head>
<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
	<!-- Begin page -->
    <div class="wrapper">
       @include('includes.sidebar')
        <div class="content-page">
         	<div class="content">
         		<!-- Topbar Start -->
            	@include('includes.navbar') 
            	<!-- Topbar End -->

            	<!-- Content Start -->
            	@yield('content')
            	<!-- Content End -->
            </div>
        </div>
	</div>

    @yield('addModal')
    @yield('editModal')
    @yield('deleteModal')

	<!-- bundle -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>

    <!-- third party js -->
    <script src="{{ asset('js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/vendor/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/vendor/dataTables.checkboxes.min.js') }}"></script>
    <!-- third party js ends -->


    @yield('scripts')
    
</body>
</html>