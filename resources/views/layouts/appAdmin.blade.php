<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('assets/adminPanel/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('assets/adminPanel/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    {{-- Bootstrap Select Css --}}
    <link href="{{ asset('assets/adminPanel/plugins/bootstrap-select/css/bootstrap-select.min.css')}} " rel="stylesheet">

    {{-- Bootstrap DataTables --}}
    <link href="{{ asset('assets/adminPanel/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css') }} " rel="stylesheet">

    {{-- Bootstrap Tags Input --}}
    <link href="{{ asset('assets/adminPanel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" />

    <!-- Waves Effect Css -->
    <link href="{{ asset('assets/adminPanel/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('assets/adminPanel/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('assets/adminPanel/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('assets/adminPanel/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('assets/adminPanel/css/themes/all-themes.css')}}" rel="stylesheet" />
</head>
<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
        @include('inc.admin.topNav')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
            @include('inc.admin.leftNav')
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
            @include('inc.admin.rightNav')
        <!-- #END# Right Sidebar -->
    </section>

    {{-- Start of content --}}
    <section class="content">
       @yield('content')
    </section>
    {{-- #END# of Content --}}


    <!-- Jquery Core Js -->
    <script src="{{ asset('assets/adminPanel/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('assets/adminPanel/plugins/bootstrap/js/bootstrap.js') }}"></script>

     {{-- Jquery Datatable --}}
     <script src="{{ asset('assets/adminPanel/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>

     <script src="{{ asset('assets/adminPanel/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }} "></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/adminPanel/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    {{-- Bootstrap Tags Input Js --}}
    <script src="{{ asset('assets/adminPanel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('assets/adminPanel/plugins/jquery-slimscroll/jquery.slimscroll.js') }}" ></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('assets/adminPanel/plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/adminPanel/plugins/jquery-countto/jquery.countTo.js') }}"></script>

   
    <!-- Morris Plugin Js -->
    <script src="{{ asset('assets/adminPanel/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/plugins/morrisjs/morris.js') }}"></script>


    <!-- ChartJs -->
    <script src="{{ asset('assets/adminPanel/plugins/chartjs/Chart.bundle.js')}}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('assets/adminPanel/plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/plugins/flot-charts/jquery.flot.time.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('assets/adminPanel/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('assets/adminPanel/js/admin.js') }}"></script>
    
    @if(is_active('admin.dashboard'))
        <script src="{{ asset('assets/adminPanel/js/pages/index.js') }}"></script>
    @endif
    
    <script src="{{ asset('assets/adminPanel/js/myApp.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('assets/adminPanel/js/demo.js') }}"></script>
    <script src="{{ asset('assets/adminPanel/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#dataTable").dataTable();
            @if(is_active('content.*'))
                CKEDITOR.replace('editor-uses');
                CKEDITOR.replace('editor-howItWorks');
                CKEDITOR.replace('editor-sideEffects');
            @endif
            
            @if(is_active('article.*'))
                CKEDITOR.replace('editor-description');
            @endif
            

            // AJAX CALLS 
            // Unverified Section
            let gstVerifyBtn = document.querySelectorAll('.gstVerifyBtn');
            let drugVerifyBtn = document.querySelectorAll('.drugVerifyBtn');
            let blacklistBtn = document.querySelectorAll('.blacklistBtn');
            let deleteBtn = document.querySelectorAll('.deleteBtn');
            let confirm;
            let blacklistForm = document.querySelectorAll('.blacklistForm');

            if(blacklistForm !== null) {
                blacklistForm.forEach(function(singleBlacklistForm, index) {
                    singleBlacklistForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        confirm = window.confirm('Are you sure you want to blacklist this user ?');

                        if(confirm) {
                            blacklistBtn[index].disabled = true;
                            singleBlacklistForm.submit();
                        } else {
                            return;
                        }

                        e.preventDefault();
                    });
                });
            }

            if(gstVerifyBtn !== null) {
               gstVerifyBtn.forEach(function(gstVerifyBtnSingle) {

                   gstVerifyBtnSingle.addEventListener('click', function(e) {
                        confirm = window.confirm("Are you sure you want to verify this user ?");

                        if(confirm) {
                            // If admin wants to verify user
                            let token = $('meta[name="csrf-token"').attr('content');
                            let loading = e.target.nextElementSibling;
                            let gstUserId = e.target.nextElementSibling.nextElementSibling.value;
                            e.target.style.display = "none";
                            $(loading).show();
                            $.ajax({
                               url: '/users/unverified',
                               type: "PUT",
                               data: {_token: token, gstUserId: gstUserId},

                               success: function(data) {
                                    loading.style.display = "none";
                                    e.target.style.display = "block";
                                    e.target.disabled = true;
                                    alert("User Gst Id verified successfully");
                               },

                               error: function(data) {
                                   console.log(data);
                               }
                            });
                        } else {
                            return;
                        }
                   }); // end of event listener
               }); // end of for each
            }

            // Drug Verify Ajax Call
            if(drugVerifyBtn != null) {
                drugVerifyBtn.forEach(function(drugVerifyBtnSingle) {

                drugVerifyBtnSingle.addEventListener('click', function(e) {
                    confirm = window.confirm("Are you sure you want to verify this user ?");

                    if(confirm) {
                            // If admin wants to verify user
                            token = $('meta[name="csrf-token"').attr('content');
                            loading = e.target.nextElementSibling;
                            drugUserId = e.target.nextElementSibling.nextElementSibling.value;
                            e.target.style.display = "none";
                            $(loading).show();
                            $.ajax({
                                url: '/users/unverified',
                                type: "PUT",
                                data: {_token: token, drugUserId: drugUserId},

                                success: function(data) {
                                    loading.style.display = "none";
                                    e.target.style.display = "block";
                                    e.target.disabled = true;
                                    alert("User Drug Id verified successfully");
                                },

                                error: function(data) {
                                    console.log(data);
                                }
                            });
                        } else {
                            return;
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
