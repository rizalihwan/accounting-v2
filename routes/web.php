<?php

use Illuminate\Support\Facades\Route;

//auth management
Route::get('/', 'AuthController@loginView');
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/logout', 'AuthController@logout')->name('logout');
Route::get('register', function () {
    return view('_auth/register');
});

Route::middleware('auth')->group(function () {
    Route::get('home', 'HomeController@home')->name('home');
});
