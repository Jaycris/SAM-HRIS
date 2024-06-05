<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>HRIS | SAM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="StarCode Kh" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::to('assets/images/favicon.ico') }}">
    <!-- Layout config Js -->
    <script src="{{ URL::to('assets/js/layout.js') }}"></script>
    <!-- StarCode CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/starcode2.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
</head>
<body class="flex items-center justify-center min-h-screen py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark font-public">
            <!-- Page-content -->
            @yield('content')
            <!-- End Page-content -->
</body>
    <!-- end main content -->

            
    <script src="{{ URL::to('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/%40popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::to('assets/libs/lucide/umd/lucide.js') }}"></script>
    <script src="{{ URL::to('assets/js/starcode.bundle.js') }}"></script>
    <!--apexchart js-->
    <script src="{{ URL::to('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/pages/dashboards-hr.init.js') }}"></script>
    <!-- jQuery -->
	<script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::to('assets/js/app.js') }}"></script>
    @yield('script')
</body>
</html>