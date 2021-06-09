<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->group(function () {
    // Select2
    Route::prefix('select2')->name('select2.')->group(function () {
        // Kontak
        Route::post('/get-kontak', 'Admin\JurnalUmumController@getKontak')->name('get-kontak');
        // Akun
        Route::get('/get-akun', 'Admin\JurnalUmumController@getAkun')->name('get-akun');
    });
});
