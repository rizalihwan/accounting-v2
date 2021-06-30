<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Bank;
use App\Models\Jurnalumum;
use App\Models\Jurnalumumdetail;
use App\Models\Bkk;
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
        return view('report.neraca.index', [
            'aktiva' => Akun::where('saldo_berjalan', '!=', 0)->where('level', 'Aktiva')->orderBy('subklasifikasi_id', 'asc')->get(),
            'modal' => Akun::where('saldo_berjalan', '!=', 0)->where('level', 'Modal')->orderBy('subklasifikasi_id', 'asc')->get(),
            'kewajiban' => Akun::where('saldo_berjalan', '!=', 0)->where('level', 'Kewajiban')->orderBy('subklasifikasi_id', 'asc')->get(),
            'total_aktiva' => Akun::where('saldo_berjalan', '!=', 0)->where('level', 'Aktiva')->sum('saldo_akhir'),
            'total_modal' => Akun::where('saldo_berjalan', '!=', 0)->where('level', 'Modal')->sum('saldo_akhir'),
            'total_kewajiban' => Akun::where('saldo_berjalan', '!=', 0)->where('level', 'Kewajiban')->sum('saldo_akhir')
        ]);
    }
}
