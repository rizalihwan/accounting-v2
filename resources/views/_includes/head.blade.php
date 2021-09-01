<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
<meta name="description" content="Aplikasi Akunting TWP AD">
<meta name="keywords" content="Aplikasi Akunting TWP AD, TWP AD, Akunting TWP AD">
<meta name="author" content="Akunting">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', '') | {{ config('app.name') }}</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@stack('select2')
@livewireStyles()
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css') }}">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/horizontal-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-sweet-alerts.min.css') }}">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
<!-- END: Custom CSS-->

<link rel="icon" href="{{ asset ('img/c.png') }}">

<style>
    body {
        overflow-x: hidden;
    }
</style>

<script>
    let style = document.getElementsByClassName('nav-link-style');
    let currentSkin = localStorage.getItem('light-layout-current-skin');

    document.getElementsByTagName('html')[0].classList.add(currentSkin);
</script>
<script>
    function deleteConfirm(form_id, id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Anda tidak dapat memulihkan data ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus ini!",
            customClass:{
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-outline-danger ml-1"
            },
            buttonsStyling: false
        }).then((willDelete) => {
            if (willDelete.value) {
                $(`#${form_id}${id}`).submit();
            }
        })
    }

    function logoutConfirm() {
        Swal.fire({
            title: "Logout",
            text: "Anda akan kembali ke halaman login.",
            icon: "warning",
            showCancelButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonText: "Logout",
            customClass: {
                confirmButton:"btn btn-primary",
                cancelButton:"btn btn-outline-danger ml-1"
            },
            buttonsStyling: false,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return new Promise((resolve) => {
                    const CSRF = $('meta[name="csrf-token"]').attr('content');
                    
                    $.ajax({
                        url: '{{ route('logout') }}',
                        type: 'post',
                        data: {
                            _token: CSRF
                        },
                        error: () => window.location.href = '{{ route('login') }}'
                    });

                    // setTimeout(function() {
                    //     console.log('logic ends');
                    //     resolve();
                    // }, 5000);
                });
            }
        })
    }
</script>

@stack('head')
