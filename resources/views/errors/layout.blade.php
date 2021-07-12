<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <!-- BEGIN: Head-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

        <title>@yield('title')</title>
        
        <link rel="icon" href="{{ asset ('img/c.png') }}">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.min.css') }}">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/horizontal-menu.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-misc.min.css') }}">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <!-- END: Custom CSS-->

        <style>
            @media only screen and (max-width: 625px) {
                .misc-inner {
                    margin-top: 50px;
                }
            }
        </style>

    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body-->
    <body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="blank-page">
        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body">
                    <!-- Error page-->
                    <div class="misc-wrapper">
                        <span class="brand-logo" style="margin-top: -14px">
                            <img src="{{ asset ('img/c.png') }}" alt="Logo TNI" style="width: 40px; height: 60px; object-fit: contain;">
                            <h2 class="text-dark ml-1 my-auto"><strong>DIGKUAD</strong></h2>
                        </span>
                        <div class="misc-inner p-2 p-sm-3">
                            <div class="w-100 text-center">
                                <h2 class="mb-1">@yield('message')</h2>
                                <p class="mb-2">@yield('description')</p>
                                <a class="btn btn-primary mb-2 btn-sm-block" href="{{ route('home') }}">Back to home</a>
                                <img class="img-fluid" src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/pages/error.svg" alt="Error page"/>
                            </div>
                        </div>
                    </div>
                    <!-- / Error page-->
                </div>
            </div>
        </div>
        <!-- END: Content-->


        <!-- BEGIN: Vendor JS-->
        <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
        <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
        <!-- END: Theme JS-->

        <script>
            $(window).on('load',  function(){
                if (feather) {
                feather.replace({ width: 14, height: 14 });
                }
            })
        </script>
    </body>
    <!-- END: Body-->

</html>