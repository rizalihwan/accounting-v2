<?php

use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
    //auth management
    Route::get('/login', 'AuthController@loginView')->name('login');
    // Route::post('/login', 'AuthController@login')->name('login');
});
Route::middleware('auth')->group(function () {

    Route::prefix('/menu')->name('menu.')->group(function () {
        Route::get('/');
    });

    Route::get('/', 'HomeController@home')->name('home');
    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
        Route::prefix('data-store')->group(function () {
            Route::view('/', 'menu')->name('data-store');

            // Kontak
            Route::resource('kontak', 'KontakController');
            Route::post('/kontak/kode-kontak', 'KontakController@kontakKode')->name('kontak.kode');
            // Kategori
            Route::resource('kategori', 'KategoriController');
            //Category
            Route::view('category', 'admin.category.index')->name('category.index');
            // Divisi
            Route::view('divisi', 'admin.divisi.index')->name('divisi.index');
            // Unit
            Route::view('unit', 'admin.unit.index')->name('unit.index');
            // Produk
            Route::resource('product', 'ProductController');
        });

        Route::prefix('ledger')->group(function () {
            Route::view('/', 'menu')->name('ledger');

            // Akun
            Route::resource('akun', 'AkunController');
            // Subklasifikasi
            Route::view('subklasifikasi', 'admin.subklasifikasi.index')->name('subklasifikasi.index');
            // Rekening
            Route::resource('rekening', 'RekeningController')->except(['store', 'update', 'destroy']);
            // Bank
            Route::resource('bank', 'BankController');

            // Buku Besar
            Route::get('/bukubesar', 'BukuBesarController@index')->name('bukubesar.index');
            // Jurnal Umum
            Route::resource('jurnalumum', 'JurnalUmumController');
        });

        Route::prefix('sales')->group(function () {
            Route::view('/', 'menu')->name('sales');
        });

        Route::prefix('purchase')->group(function () {
            Route::view('/', 'menu')->name('purchase');
        });
        Route::prefix('cash-bank')->group(function () {
            Route::view('/', 'menu')->name('cash-bank');
            
            // Bkk
            Route::resource('bkk', 'BkkController')->except('calculateResult');
            Route::get('calculate/', 'BkkController@calculateResult')->name('bkk.calculate');
            // Bkm
            Route::resource('bkm', 'BkmController');
        });

        Route::prefix('inventory')->group(function () {
            Route::view('/', 'menu')->name('inventory');
        });

        Route::prefix('report')->group(function () {
            Route::view('/', 'menu')->name('report');
        });
    });
});
