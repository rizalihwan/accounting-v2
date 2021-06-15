<div>
    <div class="card mb-0">
        <div class="card-body">
            <a href="javascript:void(0);" class="brand-logo">
                <img src="{{ asset ('img/logo-tni.png') }}" alt="logo tni" style="width: 50px; height: 70px;">
                <h2 class="brand-text text-primary ml-1 mt-2">DITKUAD</h2>
            </a>

            <h4 class="card-title mb-1" style="text-align: center;">Selamat Datang di Aplikasi Akunting TNI AD</h4>
            <p class="card-text mb-2">Mohon masukan username dan password anda untuk Sign-in</p>

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
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" wire:model="username" class="form-control"
                        placeholder="Username" aria-describedby="username" tabindex="1" autofocus />
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="password">Password</label>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input type="password" id="password" name="password" wire:model="password"
                            class="form-control form-control-merge" tabindex="2"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <div class="input-group-append">
                            <span class="input-group-text cursor-pointer">
                                <x-feathericon-eye />
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group my-2">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="remember-me" wire:model="remember"
                            tabindex="3" />
                        <label class="custom-control-label" for="remember-me"> Remember Me </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block" tabindex="4" 
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
</div>
