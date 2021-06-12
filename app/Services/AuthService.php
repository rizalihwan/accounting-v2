<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials, bool $remember = false): Bool
    {
        return Auth::attempt($credentials, $remember);
    }
}
