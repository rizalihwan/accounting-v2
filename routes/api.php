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
        Route::prefix('kontak')->name('kontak.')->group(function () {
            Route::post('/nasabah', 'Api\KontakController@getNasabah')->name('nasabah');
            Route::post('/petugas', 'Api\KontakController@getPetugas')->name('petugas');
        });
        // Akun
        Route::post('/get-akun', 'Admin\JurnalUmumController@getAkun')->name('get-akun');
        Route::get('/get-akun/{akun}', 'Admin\JurnalUmumController@akunSelected')->name('get-akun.selected');
        // Divisi
        Route::post('/get-divisi', 'Admin\JurnalUmumController@getDivisi')->name('get-divisi');
        Route::get('/get-divisi/{divisi}', 'Admin\JurnalUmumController@divisiSelected')->name('get-divisi.selected');

        // pelanggan
        Route::post('/get-pelanggan', 'Api\SalesController@getPelanggan')->name('get-pelanggan');
        Route::get('/get-pelanggan/{kontak}', 'Api\SalesController@pelangganSelected')->name('get-pelanggan.selected');
        //pemasok
        Route::post('/get-pemasok', 'Api\BuyController@getPemasok')->name('get-pemasok');

        //product
        Route::post('/get-product', 'Api\SalesController@getProduct')->name('get-product');
        Route::get('/get-product/{product}', 'Api\SalesController@selectedProduct')->name('get-product.selected');

        //product buy
        Route::post('/get-buy-product', 'Api\BuyController@getProduct')->name('get-buy-product');
        Route::get('/get-buy-product/{product}', 'Api\BuyController@selectedProduct')->name('get-buy-product.selected');

        //penawaran
        Route::post('/get-sale-penawaran', 'Api\SalesController@getPenawaran')->name('get-sale-penawaran');
        Route::post('/get-buy-penawaran', 'Api\BuyController@getPenawaran')->name('get-buy-penawaran');

        //pesanan
        Route::post('/get-sale-pesanan', 'Api\SalesController@getPesanan')->name('get-sale-pesanan');
        Route::post('/get-buy-pesanan', 'Api\BuyController@getPesanan')->name('get-buy-pesanan');

        //faktur
        Route::post('/get-sale-faktur', 'Api\SalesController@getFaktur')->name('get-sale-faktur');
        // Route::post('/get-buy-pesanan', 'Api\BuyController@getPesanan')->name('get-buy-pesanan');

        //faktur
        Route::post('/get-akun/faktur', 'Api\SalesController@getAkun')->name('get-akun-faktur');
    });

    /**
     * PENJUALAN
     */
    // Get Faktur Detail by:faktur_id
    Route::get('/get-sale-faktur-details/{faktur_id}', 'Api\SalesController@getFakturDetails')->name('get-sale-faktur.details');

    /**
     * PEMBELIAN
     */
    // Get Penawaran Detail by:pesanan_id
    Route::get('/get-buy-penawaran-detail/{penawaran_id}', 'Api\BuyController@getPenawaranDetails')->name('get-buy-penawaran.details');

    // Get Pesanan Detail by:pesanan_id
    Route::get('/get-buy-pesanan-detail/{pesanan_id}', 'Api\BuyController@getPesananDetails')->name('get-buy-pesanan.details');

    // Get Penerimaan Detail by:terima_id
    Route::get('/get-buy-penerimaan-detail/{terima_id}', 'Api\BuyController@getPenerimaanDetails')->name('get-buy-penerimaan.details');

    // Get Faktur Detail by:faktur_id
    Route::get('/get-buy-faktur-detail/{faktur_id}', 'Api\BuyController@getFakturDetails')->name('get-buy-faktur.details');
    /**==== END PEMBELIAN ======*/

    // Kas & Bank ++++++++++++++++++++++++++
    Route::name('bkk.')->group(function () {
        Route::get('bkk_details/{bkk_id}', 'Api\KasController@getBkkDetail')->name('details');
    });
    // END Kas & Bank ======================

    // Get template jurnal
    Route::prefix('template-jurnal')->name('template-jurnal.')->group(function () {
        Route::get('/{id}', 'Api\TemplateJurnalController@selected')->name('selected');
        Route::post('datatables', 'Api\TemplateJurnalController@getTemplateDatatables')->name('datatables');
    });
});
