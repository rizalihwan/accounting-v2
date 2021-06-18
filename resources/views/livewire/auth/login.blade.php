<div>
    <div class="auth-inner">
        <div class="row">

            <div class="col-lg-8">
                <span class="brand-logo ml-2">
                    <img src="{{ asset ('img/logo-tni.png') }}" alt="Logo TNI" style="width: 38px; height: 58px; object-fit: contain">
                    <h2 class="brand-text text-primary ml-1 my-auto text-light">DITKUAD</h2>
                </span>
                <img class="img-cover" width="105%" height="100%" src="{{ asset ('img/login.jpeg') }}" alt="Login V2" />
            </div>
            <!-- /Left Text-->

            <!-- Login-->
            <div class="d-flex col-lg-4 align-items-center justify-content-center auth-bg px-2 p-lg-5">

                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <span class="brand-logo" style="margin-top: -100px;margin-left : -10px">
                        <img src="{{ asset ('img/c.png') }}" alt="Logo TNI" style="width: 40px; height: 60px; object-fit: contain">
                        <h1 class="brand-text text-primary ml-1 my-auto text-dark">DIGKUAD</h1>
                    </span>

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
                            <input id="username" type="text" name="username" wire:model="username" class="form-control" placeholder="Username" aria-describedby="username" autofocus tabindex="1" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" id="password" name="password" wire:model="password" aria-describedby="password" class="form-control form-control-merge" placeholder="············" tabindex="2" />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer">
                                        <x-feathericon-eye />
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox my-2">
                                <input type="checkbox" id="remember-me" wire:model="remember" class="custom-control-input" tabindex="3" />
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
    </div>

</div>
