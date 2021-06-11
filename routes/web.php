<?php

use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
    //auth management
    Route::get('/login', 'AuthController@loginView');
    Route::post('/login', 'AuthController@login')->name('login');
});
Route::middleware('auth')->group(function () {

    Route::prefix('/menu')->name('menu.')->group(function(){
        Route::get('/');
    });

    Route::get('/', 'HomeController@home')->name('home');
    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
        // Jurnal Umum
        Route::resource('jurnalumum', 'JurnalUmumController');
        // Buku Besar
        Route::get('/bukubesar', 'BukuBesarController@index')->name('bukubesar.index');
        // Kategori
        Route::resource('kategori', 'KategoriController');
        // Kontak
        Route::resource('kontak', 'KontakController');
        Route::post('/kontak/kode-kontak', 'KontakController@kontakKode')->name('kontak.kode');
        // Rekening
        Route::resource('rekening', 'RekeningController')->except(['store', 'update', 'destroy']);
        // Bank
        Route::resource('bank', 'BankController');
        // Divisi
        Route::view('divisi', 'admin.divisi.index')->name('divisi.index');
        // Bkk
        Route::resource('bkk', 'BkkController')->except('calculateResult');
        Route::get('calculate/', 'BkkController@calculateResult')->name('bkk.calculate');
        // Bkm
        Route::resource('bkm', 'BkmController');
        //Category
        Route::view('category', 'admin.category.index')->name('category.index');
        // Unit
        Route::view('unit', 'admin.unit.index')->name('unit.index');
        // Produk
        Route::resource('product', 'ProductController');
        // Subklasifikasi
        Route::resource('subklasifikasi', 'SubklasifikasiController');
        // Akun
        Route::resource('akun', 'AkunController');
    });
});


Route::view('/data_store','menu');
Route::view('/ledger','menu');
Route::view('/sales','menu');
Route::view('/purchase','menu');
Route::view('/cash_and_bank','menu');
Route::view('/inventory','menu');
Route::view('/report','menu');
