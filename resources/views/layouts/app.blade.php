<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('assets/adminPanel/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('assets/adminPanel/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    {{-- Bootstrap Select Css --}}
    <link href="{{ asset('assets/adminPanel/plugins/bootstrap-select/css/bootstrap-select.min.css')}} " rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('assets/adminPanel/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('assets/adminPanel/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('assets/adminPanel/css/style.css')}}" rel="stylesheet">
</head>

<body class="login-page">
   
    @yield('content')

    <!-- Jquery Core Js -->
    <script src="{{ asset('assets/adminPanel/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('assets/adminPanel/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/adminPanel/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    
    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('assets/adminPanel/plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ asset('assets/adminPanel/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('assets/adminPanel/js/admin.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/js/pages/examples/sign-in.js') }}"></script>
</body>

</html>