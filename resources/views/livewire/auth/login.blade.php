<div>

    <div class="auth-inner row m-0">
        <!-- Brand logo-->
        <span class="brand-logo" style="margin-top: -15px">
            <img src="{{ asset ('img/logo-tni.png') }}" alt="Logo TNI" style="width: 38px; height: 58px; object-fit: contain">
            <h1 class="brand-text text-primary ml-1 my-auto text-warning">DITKUAD</h1>
        </span>
        <!-- /Brand logo-->

        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                <img class="img-fluid" src="{{ asset ('img/loginpage.png') }}" alt="Login V2"/>
            </div>
        </div>
        <!-- /Left Text-->

        <!-- Login-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <span class="brand-logo ml-5" style="">
                <img src="{{ asset ('img/c.png') }}" alt="Logo TNI" style="width: 38px; height: 58px; object-fit: contain">
                <h1 class="brand-text text-primary ml-1 my-auto text-warning">DIGKUAD</h1>
            </span>
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <h2 class="card-title font-weight-bold mb-1">Aplikasi Online Keuangan TNI AD</h2>
                <p class="card-text mb-2">Silahkan masukan akun Anda</p>
                <form class="auth-login-form mt-2" wire:submit.prevent="login">
                    @if (session()->has('error'))
                        <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                            <div class="alert-body">
                                <x-feathericon-info class="mr-50 align-middle" />
                                <span>{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                            <div class="alert-body">
                                @foreach ($errors->all() as $error)
                                <ul style="margin: 0 12px 0 -11px">
                                    <li>{{ $error }}</li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input id="username" type="text" name="username" wire:model="username" 
                            class="form-control" placeholder="Username" aria-describedby="username" autofocus tabindex="1"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" id="password" name="password" wire:model="password" aria-describedby="password" 
                            class="form-control form-control-merge" placeholder="············" tabindex="2"/>
                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer">
                                    <x-feathericon-eye />
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox my-2">
                            <input type="checkbox" id="remember-me" wire:model="remember"
                                class="custom-control-input" tabindex="3"/>
                            <label class="custom-control-label" for="remember-me"> Remember Me</label>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" tabindex="4"
                        wire:loading.attr="disabled" wire:target="login">
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

</div>
