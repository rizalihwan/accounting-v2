<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title','') | Accounting</title>
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
                <!-- BADGE INFO -->
                @include('_includes.info')

                <!-- BEGIN:CONTENT -->
                @yield('content')
                <!-- END:CONTENT -->
            </div>
        </div>

    </div>
    <!-- END: CONTENT -->

    <!-- BEGIN: FOOTER -->
    @include('_components.footer')
    <!-- END: FOOTER -->

    <!-- SCRIPT -->
    @include('_includes.script')
</body>

</html>
