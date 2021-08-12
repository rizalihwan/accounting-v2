<?php

namespace App\Http\Controllers;

use App\Models\{Akun, Bkk, Jurnalumumdetail};
use App\Models\Purchase\FakturBuy;
use App\Models\Sale\FakturSale;
use Illuminate\Support\Facades\DB;

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

        $kas = Akun::orderBy('kredit', 'desc')->get();
        return view('home', [
            'kas' => $kas,
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
