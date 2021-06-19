<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
