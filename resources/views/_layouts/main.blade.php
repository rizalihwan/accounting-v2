<!doctype html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">

<head>
    <!-- initiate head with meta tags, css and script -->
    @include('_includes.head')
</head>

<body class="horizontal-layout horizontal-menu navbar-floating footer-static" data-open="hover" data-menu="horizontal-menu" data-col="">
    <!-- BEGIN: NAVBAR -->
    @include('_components.navbar')
    <!-- END: NAVBAR -->
    <!-- BEGIN:CONTENT -->
    <div class="app-content content">

        @include('_components.overlay')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @include('_components.bread')

            <div class="content-body">
                <!-- BEGIN:CONTENT -->
                @yield('content')
                <!-- END:CONTENT -->
            </div>
        </div>

    </div>
    <!-- END: CONTENT -->
    
    <!-- Begin: Customizer -->
    @include('_components.customizer')
    <!-- End: Customizer -->

    <!-- BEGIN: FOOTER -->
    @include('_components.footer')
    <!-- END: FOOTER -->

    <!-- SCRIPT -->
    @include('_includes.script')
    @include('_include.alert')
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
</body>

</html>
