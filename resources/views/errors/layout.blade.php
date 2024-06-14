<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Title -->
    <title> Error : @yield("title") </title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/x-icon" />

    <!-- Internal Fontawesome css -->
    <link href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Ionicons css -->
    <link href="{{ asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

    <!-- Internal Typicons css -->
    <link href="{{ asset('assets/plugins/typicons.font/typicons.css') }}" rel="stylesheet">

    <!-- Internal Feather css -->
    <link href="{{ asset('assets/plugins/feather/feather.css') }}" rel="stylesheet">

    <!-- Internal Flag-icons css -->
    <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Dark-mode css -->
    <link href="{{ asset('assets/css/style-dark.css') }}" rel="stylesheet">

    <!-- Skinmodes css -->
    <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet">


</head>

<body class="main-body bg-primary-transparent">

    <!-- Page -->
    <div class="page">

        @yield("content")

    </div>
    <!-- End Page -->
    <!-- JQuery min js -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Bundle js -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Ionicons js -->
    <script src="{{ asset('assets/plugins/ionicons/ionicons.js') }}"></script>

    <!-- Moment js -->
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>

    <!-- eva-icons js -->
    <script src="{{ asset('assets/js/eva-icons.min.js') }}"></script>

    <!-- Rating js -->
    <script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>
    <script src="{{ asset('assets/plugins/rating/jquery.barrating.js') }}"></script>

    <!-- custom js -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>


</body>

</html>
