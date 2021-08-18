<?php

namespace App\Http\Controllers;

use App\Models\{Akun, Bkk, Jurnalumumdetail};
use App\Models\Purchase\FakturBuy;
use App\Models\Sale\FakturSale;

class HomeController extends Controller
{
    public function home()
    {
        $akun = Akun::select('debit', 'kredit');
        $sumSaldoAkhir = $akun->sum('debit') - $akun->sum('kredit');
        $sumJurnalUmum = Jurnalumumdetail::sum('debit');
        $sumFakturPenjualan = FakturSale::sum('total');
        $sumFakturPembelian = FakturBuy::sum('total');

        $kerugianOrKeuntungan = $sumJurnalUmum + $sumFakturPenjualan - $sumFakturPembelian;
        $penerimaanAtas = $sumJurnalUmum + $sumFakturPenjualan;
        $result = $kerugianOrKeuntungan < 1 ? 'Kerugian' : 'Keuntungan';
        $sumExpense = Bkk::where('status', 'BKK')->sum('value');
        $sumIncome = Bkk::where('status', 'BKM')->sum('value');

        $piutang = Akun::orderBy('debit','desc')->get();
        $hutang = Akun::orderBy('kredit', 'desc')->get();

        $akun = Akun::orderBy('kode','asc')->get();

        return view('home', [
            'piutang' => $piutang,
            'hutang' => $hutang,
            'akun' => $akun,
            'saldoKeseluruhan' => $sumSaldoAkhir,
            'kerugianOrKeuntungan' => $kerugianOrKeuntungan,
            'result' => $result,
            'penerimaanAtas' => $penerimaanAtas,
            'pengeluaranAtas' => $sumFakturPembelian,
            'penerimaanBawah' => $sumJurnalUmum + $sumExpense + $sumIncome,
            'pengeluaranBawah' => $sumExpense + $sumIncome
        ]);
    }
}
