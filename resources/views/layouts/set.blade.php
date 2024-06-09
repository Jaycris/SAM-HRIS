<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>

    <meta charset="utf-8">
    <title>Set Password | SAM HRIS Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="HRIS SAM" name="description">
    <meta content="SAM" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- StarCode CSS -->
    <link rel="stylesheet" href="assets/css/starcode2.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">

</head>

<body class="flex items-center justify-center min-h-screen py-16 bg-auth lg:py-10 bg-slate-50 dark:bg-zink-800 dark:text-zink-100 font-public">

    @yield('content')

    <script src='assets/libs/choices.js/public/assets/scripts/choices.min.js'></script>
    <script src="assets/libs/%40popperjs/core/umd/popper.min.js"></script>
    <script src="assets/libs/tippy.js/tippy-bundle.umd.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/prismjs/prism.js"></script>
    <script src="assets/libs/lucide/umd/lucide.js"></script>
    <script src="assets/js/starcode.bundle.js"></script>
    <script src="assets/js/pages/auth-login.init.js"></script>

</body>

</html>