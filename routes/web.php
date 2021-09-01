<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
    //auth management
    Route::get('/login', 'AuthController@loginView')->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/login-redirects', function () {
        return redirect(Redirect::intended()->getTargetUrl());
    })->name('login-redirects');
    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::get('/', 'HomeController@home')->name('home');

    Route::prefix('/menu')->name('menu.')->group(function () {
        Route::get('/');
    });

    //edit profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/setting', 'ProfileController@edit')->name('setting');
        Route::patch('/setting/update', 'ProfileController@update')->name('update');
    });
    // change password
    Route::prefix('account')->name('password.')->group(function () {
        Route::get('/password', 'ProfileController@changePassword')->name('edit');
        Route::patch('/password', 'ProfileController@updatePassword')->name('edit');
    });

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
            // Akun
            Route::view('akun', 'admin.akun.index')->name('akun.index');
            // Rekening
            Route::resource('rekening', 'RekeningController')->except(['store', 'update', 'destroy']);
            // Bank
            // Route::resource('bank', 'BankController');
        });

        Route::prefix('ledger')->group(function () {
            Route::view('/', 'menu')->name('ledger');

            // Buku Besar
            Route::prefix('bukubesar')->name('bukubesar.')->group(function () {
                Route::get('/', 'BukuBesarController@index')->name('index');
                Route::post('/cari-akun', 'BukuBesarController@cariakun')->name('cariakun');

            });
            // Jurnal Umum
            Route::resource('jurnalumum', 'JurnalUmumController');
            // Template Jurnal Umum
            Route::resource('template-jurnal', 'TemplateJurnalController');
        });

        Route::prefix('sales')->name('sales.')->group(function () {
            Route::view('/', 'menu');
            Route::resource('penawaran', 'Sales\PenawaranController');
            Route::resource('pesanan', 'Sales\PesananController');
            Route::resource('pengiriman', 'Sales\PengirimanController');
            Route::resource('faktur', 'Sales\FakturController');
            Route::get('piutang', 'Sales\PiutangController@index')->name('piutang.index');
            Route::resource('pembayaran', 'Sales\PembayaranPiutangController');
        });

        Route::prefix('purchase')->name('purchase.')->group(function () {
            Route::view('/', 'menu');
            Route::resource('penawaran', 'Purchase\PenawaranbuyController');
            Route::resource('pesanan', 'Purchase\PesananbuyController');
            Route::resource('terima', 'Purchase\TerimabuyController');
            Route::resource('faktur', 'Purchase\FakturBuyController');
            Route::get('piutang', 'Purchase\PiutangController@index')->name('piutang.index');
            Route::resource('pembayaran', 'Purchase\PembayaranPiutangController');
        });
        Route::prefix('cash-bank')->group(function () {
            Route::view('/', 'menu')->name('cash-bank');

            // Bkk
            Route::resource('bkk', 'BkkController')->except('calculateResult');
            Route::get('calculate/', 'BkkController@calculateResult')->name('bkk.calculate');
            // Bkm
            Route::resource('bkm', 'BkmController');
        });

        Route::prefix('simpanpinjam')->group(function () {
            Route::view('/', 'menu')->name('simpanpinjam');

            // Simpan
            Route::get('simpan/import/form', 'SimpanController@import_form')->name('simpan.import_form');
            Route::post('simpan/import', 'SimpanController@import')->name('simpan.import');
            Route::get('simpan/export', 'SimpanController@export')->name('simpan.export');
            Route::resource('simpan', 'SimpanController');

            //Pinjam
            Route::get('/pinjam/import/form', 'PinjamController@import_form')->name('pinjam.import_form');
            Route::post('/pinjam/import', 'PinjamController@import')->name('pinjam.import');
            Route::get('/pinjam/export', 'PInjamController@export')->name('pinjam.export');
            Route::resource('pinjam', 'PinjamController');
            Route::post('/pinjam/detail', 'PinjamController@detail')->name('pinjam.detail');
        });

        Route::prefix('report')->name('report.')->group(function () {
            // menu report
            Route::get('/', function(){
                return redirect()->route('admin.report.keuangan.menu');
            })->name('menu');
            Route::name('keuangan.')->prefix('keuangan')->group(function () {
                Route::view('/', 'report.menu')->name('menu');

                // jurnal umum report
                Route::get('/jurnal-umum', 'ReportController@jurnalumum')->name('jurnalumum');
                Route::get('/jurnal-umum/search', 'ReportController@jurnalumumcari')->name('jurnalumum.cari');

                // buku kas report
                Route::get('/buku-kas/{nama}', 'ReportController@kas')->name('kas');
                Route::get('/buku-kas/search/{nama}', 'ReportController@kascari')->name('kas.cari');

                Route::get('/neraca', 'ReportController@neraca')->name('neraca.index');

                Route::get('/neraca/detail/{id}', 'ReportController@neraca_detail')->name('neraca.detail');

                Route::get('/neraca/pdf', 'ReportController@neraca_pdf')->name('neraca.pdf');
                Route::get('/neraca/excel', 'ReportController@neraca_excel')->name('neraca.excel');

                Route::get('/labarugi', 'ReportController@labarugi')->name('labarugi');
                Route::get('/labarugi/pdf', 'ReportController@labarugi_pdf')->name('labarugi.pdf');
                Route::get('/labarugi/excel', 'ReportController@labarugi_excel')->name('labarugi.excel');

                Route::get('/bukubesar', 'ReportController@bukubesar')->name('bukubesar');
                Route::get('/bukubesar/cari', 'ReportController@bukubesarcari')->name('bukubesar.cari');
            });

            // Route::name('penjualandanpiutang.')->prefix('penjualandanpiutang')->group(function () {
            //     // laba rugi report
            //     Route::view('/labarugi', 'report.keuangan.labarugi')->name('labarugi');
            // });
            Route::name('penjualandanpiutang.')->prefix('penjualandanpiutang')->group(function () {
                Route::view('/', 'report.menu')->name('menu');
            });
            Route::name('pembeliandanutang.')->prefix('pembeliandanutang')->group(function () {
                Route::view('/', 'report.menu')->name('menu');
            });
            Route::name('produk.')->prefix('produk')->group(function () {
                Route::view('/', 'report.menu')->name('menu');
            });
        });
    });
});
