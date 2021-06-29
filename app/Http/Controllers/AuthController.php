<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('_auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        $remember = !empty($request->remember);

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('home')->with('success', 'selamat datang');
        } else {
            return redirect()->back()->with('error', 'username atau password salah');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
