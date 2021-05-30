<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//auth login
Route::get('/login', 'AuthController@loginView');
Route::post('/login', 'AuthController@login')->name('login');

Route::get('register', function () {
    return view('_auth/register');
});

Route::get('home', function () {
    return view('index');
});
