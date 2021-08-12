<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Bank;
use App\Models\Jurnalumum;
use App\Models\Jurnalumumdetail;
use App\Models\Bkk;
use App\Models\Purchase\FakturBuy;
use App\Models\Sale\FakturSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function menu()
    {
        return view('report.menu');
    }

    public function jurnalumum()
    {
        return view('report.keuangan.jurnalumum');
    }

    public function jurnalumumcari(Request $request)
    {
        $request->validate([
            'startDate' => 'required',
            'endDate' => 'required',
        ]);
        $from = $request->startDate;
        $to = $request->endDate;
        $startDate = $from;
        $endDate = $to;
        $data = Jurnalumumdetail::whereBetween('created_at', [$startDate, $endDate])->latest()->paginate(10);
        return view('report.keuangan.jurnalumum', compact('data', 'startDate', 'endDate'));
    }

    public function kas($nama)
    {
        if ($nama == 'Bkk') {
            $bkk = Bkk::where('status', 'BKK')->latest()->paginate(10);
            return view('report.keuangan.bkk', compact('bkk'));
        }
        $bkm = Bkk::where('status', 'BKM')->latest()->paginate(10);
        return view('report.keuangan.bkm', compact('bkm'));
    }

    public function kascari(Request $request, $nama)
    {
        if ($nama == 'Bkk') {
            $request->validate([
                'startDate' => 'required',
                'endDate' => 'required',
            ]);
            $from = $request->startDate;
            $to = $request->endDate;
            $startDate = $from;
            $endDate = $to;
            $bkk = Bkk::where('status', 'BKK')->whereBetween('tanggal', [$startDate, $endDate])->latest()->paginate(10);
            return view('report.keuangan.bkk', compact('bkk', 'startDate', 'endDate'));
        }
        $request->validate([
            'startDate' => 'required',
            'endDate' => 'required',
        ]);
        $from = $request->startDate;
        $to = $request->endDate;
        $startDate = $from;
        $endDate = $to;
        $bkm = Bkk::where('status', 'BKM')->whereBetween('tanggal', [$startDate, $endDate])->latest()->paginate(10);
        return view('report.keuangan.bkm', compact('bkm', 'startDate', 'endDate'));
    }
    public function neraca()
    {
        // $akuns = Akun::where('saldo_berjalan','!=',0)->where('level','Aktiva')->orderBy('subklasifikasi_id','asc')->get();

        // foreach($akuns->unique('subklasifikasi_id') as $data){
        //     echo $data->subklasifikasi->name.'<br>';
        // }
        $akun_aktiva = Akun::where('level', 'Aktiva')->orderBy('id', 'asc')->get();
        $hitung_aktiva = [];
        foreach ($akun_aktiva as $key) {
            array_push($hitung_aktiva, $key->debit - $key->kredit);
        }
        $total_aktiva = array_sum($hitung_aktiva);

        $akun_modal = Akun::where('level', 'Modal')->orderBy('id', 'asc')->get();
        $hitung_modal = [];
        foreach ($akun_modal as $key) {
            array_push($hitung_modal, $key->debit - $key->kredit);
        }
        $total_modal = array_sum($hitung_modal);

        $akun_kewajiban = Akun::where('level', 'Kewajiban')->orderBy('id', 'asc')->get();
        $hitung_kewajiban = [];
        foreach ($akun_kewajiban as $key) {
            array_push($hitung_kewajiban, $key->debit - $key->kredit);
        }
        $total_kewajiban = array_sum($hitung_kewajiban);
        

        return view('report.neraca.index', [
            'aktiva' => Akun::where('level', 'Aktiva')->orderBy('id', 'asc')->get(),
            'modal' => Akun::where('level', 'Modal')->orderBy('id', 'asc')->get(),
            'kewajiban' => Akun::where('level', 'Kewajiban')->orderBy('id', 'asc')->get(),
            'total_aktiva' => $total_aktiva,
            'total_modal' => $total_modal,
            'total_kewajiban' => $total_kewajiban
        ]);
    }
    public function labarugi()
    {
        $pendapatan = FakturSale::sum('total');
        $beban = FakturBuy::sum('total');
        $total_laba = $pendapatan - $beban;
        return view('report.keuangan.labarugi', [
            'pendapatan' => $pendapatan,
            'total_laba' => $total_laba,
            'beban' => $beban
        ]);
    }
    public function bukubesar()
    {
        return view('report.bukubesar.index', [
            'kontak' => Akun::get(),
            'akun' => Akun::get()
        ]);
    }
    public function bukubesarcari(Request $request)
    {
        $from = $request->startDate;
        $to = $request->endDate;
        $kontak = $request->kontak;
        if($kontak == 'all'){
            $akun = Akun::whereHas('jurnalumumdetails', function ($q) use ($from, $to, $kontak) {
                return $q->whereHas('jurnalumum', function ($qr) use ($from, $to, $kontak) {
                    return
                        $qr->whereBetween('tanggal', [$from, $to]);
                });
            })->get();
        }else{
            $akun = Akun::where('id',$kontak)->whereHas('jurnalumumdetails', function ($q) use ($from, $to, $kontak) {
                return $q->whereHas('jurnalumum', function ($qr) use ($from, $to, $kontak) {
                    return
                        $qr->whereBetween('tanggal', [$from, $to]);
                });
            })->get();
        }
        return view('report.bukubesar.index', [
            'kontak' => Akun::get(),
            'akun' => $akun,
            'startDate' => $from,
            'endDate' => $to
        ]);
    }

}
