<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   
    <script src="{{ asset('js/app.js') }}"></script>
  
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,300italic,700%7cRaleway:400,300,200,500,600,700,800,900%7cRoboto:400,500" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">   
    <style>
        .mail-container {
            font-family: "Raleway",sans-serif !important;
        }
    </style>
</head>
<body>
<div class="container mail-container text-center">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-6 m-auto">
            <p class="lead"> Thank you for choosing Pharmacia</p>
            <p class="lead"> You enquiry has been registered please verify your details below</p>
            <p class="lead"> Name: <strong>{{$name}}</strong></p>
            <p> Email: <strong>{{$email}}</strong></p>
            <p> Phone: <strong>{{$mobile_no}}</strong></p>
        </div>
    </div>
</div>
</body>
</html>