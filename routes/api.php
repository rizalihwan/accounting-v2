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
        Route::get('/get-kontak/{kontak}', 'Admin\JurnalUmumController@kontakSelected')->name('get-kontak.selected');
        // Akun
        Route::post('/get-akun', 'Admin\JurnalUmumController@getAkun')->name('get-akun');
        Route::get('/get-akun/{akun}', 'Admin\JurnalUmumController@akunSelected')->name('get-akun.selected');
        // Divisi
        Route::post('/get-divisi', 'Admin\JurnalUmumController@getDivisi')->name('get-divisi');
        Route::get('/get-divisi/{divisi}', 'Admin\JurnalUmumController@divisiSelected')->name('get-divisi.selected');

        // pelanggan
        Route::post('/get-pelanggan', 'Api\SalesController@getPelanggan')->name('get-pelanggan');
        Route::get('/get-pelanggan/{kontak}', 'Api\SalesController@pelangganSelected')->name('get-pelanggan.selected');

        //product
        Route::post('/get-product', 'Api\SalesController@getProduct')->name('get-product');
        Route::get('/get-product/{product}', 'Api\SalesController@selectedProduct')->name('get-product.selected');

        //penawaran
        Route::post('/get-sale-penawaran', 'Api\SalesController@getPenawaran')->name('get-sale-penawaran');

        //pesanan
        Route::post('/get-sale-pesanan', 'Api\SalesController@getPesanan')->name('get-sale-pesanan');

    });

    // Faktur
    Route::get('/get-sale-faktur-details/{id}', 'Api\SalesController@getFakturDetails')->name('get-sale-faktur.details');
});
