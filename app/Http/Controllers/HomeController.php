<?php

namespace App\Http\Controllers;

use App\Models\{Akun, Bkk, Jurnalumumdetail};
use App\Models\Purchase\FakturBuy;
use App\Models\Sale\FakturSale;

class HomeController extends Controller
{
    public function home()
    {
        $sumSaldoAkhir = Akun::sum('saldo_akhir');
        $sumJurnalUmum = Jurnalumumdetail::sum('debit');
        $sumFakturPenjualan = FakturSale::sum('total');
        $sumFakturPembelian = FakturBuy::sum('total');

        $kerugianOrKeuntungan = $sumJurnalUmum + $sumFakturPenjualan - $sumFakturPembelian;
        $penerimaanAtas = $sumJurnalUmum + $sumFakturPenjualan;
        $result = $kerugianOrKeuntungan < 1 ? 'Kerugian' : 'Keuntungan';
        $sumExpense = Bkk::where('status', 'BKK')->sum('value');
        $sumIncome = Bkk::where('status', 'BKM')->sum('value');
        return view('home', [
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
