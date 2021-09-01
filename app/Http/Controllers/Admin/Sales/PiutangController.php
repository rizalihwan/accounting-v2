<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sale\PiutangSale;
use Illuminate\Http\Request;

class PiutangController extends Controller
{
    public function index()
    {
        $piutangs = PiutangSale::where('status', '0')->paginate(10);
        
        return view('admin.sales.piutang.index', compact('piutangs'));
    }
}
