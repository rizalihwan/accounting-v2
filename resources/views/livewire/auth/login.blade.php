<div class="auth-inner row m-0">
    <!-- Logo Kiri-->
    <span class="brand-logo">
        <img src="{{ asset ('img/logo-tni.png') }}" alt="Logo TNI" style="width: 38px; height: 58px; object-fit: contain">
        <h2 class="brand-text text-light ml-1 my-auto mobile-text-dark"><strong>DITKUAD</strong></h2>
    </span>
    <!-- /Logo Kiri-->

    <!-- Gambar Kiri-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center" style="background-size: cover; background-image: url('{{ asset ('img/login.jpeg') }}');"></div>
    <!-- /Gambar Kiri-->

    <!-- Login-->
    <div class="d-flex col-lg-4 align-items-center justify-content-center auth-bg px-2 p-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">

            <h2 class="card-title font-weight-bold login-head">
                <span class="d-flex mb-1">
                    <img src="{{ asset ('img/c.png') }}" alt="Logo TNI" style="width: 40px; height: 60px; object-fit: contain">
                    <h2 class="text-dark ml-1 my-auto"><strong>DIGKUAD</strong></h2>
                </span>
                Aplikasi Online Keuangan TNI AD
            </h2>
            <p class="card-text mb-2">Silahkan masuk ke akun Anda</p>

            @if (session()->has('error'))
                <div class="alert alert-danger mt-1 alert-dismissible" role="alert">
                    <div class="alert-body">
                        <x-feathericon-info class="mr-50 align-middle" />
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mt-1 alert-validation-msg alert-dismissible" role="alert">
                    <div class="alert-body">
                        @foreach ($errors->all() as $error)
                        <ul style="margin: 0 12px 0 -11px">
                            <li>{{ $error }}</li>
                        </ul>
                        @endforeach
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form class="auth-login-form mt-2" wire:submit.prevent="login">
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" wire:model="username" aria-describedby="username" 
                        class="form-control" placeholder="Username" autofocus tabindex="1" 
                        wire:loading.attr="disabled" wire:target="login" />
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" wire:model="password" aria-describedby="password" 
                        class="form-control form-control-merge" placeholder="············" tabindex="2"
                        wire:loading.attr="disabled" wire:target="login" />
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox my-2">
                        <input type="checkbox" id="remember-me" wire:model="remember" class="custom-control-input" tabindex="3"
                            wire:loading.attr="disabled" wire:target="login" />
                        <label class="custom-control-label" for="remember-me"> Remember Me</label>
                    </div>
                </div>

                <button class="btn btn-primary btn-block" tabindex="4" wire:loading.attr="disabled" wire:target="login">
                    <span wire:loading.remove wire:target="login">Sign in</span>
                    <span wire:loading wire:target="login" class="mx-auto">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </span>
                </button>
            </form>
        </div>
    </div>
    <!-- /Login-->
</div>
