<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'startDate'=> 'required',
            'endDate'=> 'required',
        ]);
        $from = $request->startDate;
        $to = $request->endDate;
        $startDate = $from;
        $endDate = $to;
        $data = Jurnalumumdetail::whereBetween('created_at', [$startDate,$endDate])->latest()->paginate(10);
        return view('report.keuangan.jurnalumum', compact('data', 'startDate', 'endDate'));
    }

    public function kas($nama)
    {
        if ($nama == 'Bkk') {
            $bkk = Bkk::where('status','BKK')->latest()->paginate(10);
            return view('report.keuangan.bkk',compact('bkk'));
        }
        $bkm = Bkk::where('status','BKM')->latest()->paginate(10);
        return view('report.keuangan.bkm',compact('bkm'));
    }

    public function kascari(Request $request,$nama)
    {
        if ($nama == 'Bkk') {
            $request->validate([
                'startDate'=> 'required',
                'endDate'=> 'required',
            ]);
            $from = $request->startDate;
            $to = $request->endDate;
            $startDate = $from;
            $endDate = $to;
            $bkk = Bkk::where('status','BKK')->whereBetween('tanggal', [$startDate,$endDate])->latest()->paginate(10);
            return view('report.keuangan.bkk', compact('bkk', 'startDate', 'endDate'));
        }
        $request->validate([
            'startDate'=> 'required',
            'endDate'=> 'required',
        ]);
        $from = $request->startDate;
        $to = $request->endDate;
        $startDate = $from;
        $endDate = $to;
        $bkm = Bkk::where('status','BKM')->whereBetween('tanggal', [$startDate,$endDate])->latest()->paginate(10);
        return view('report.keuangan.bkm', compact('bkm', 'startDate', 'endDate'));
        
    }
}
