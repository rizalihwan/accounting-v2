<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Purchase\PiutangBuy;
use Illuminate\Http\Request;

class PiutangController extends Controller
{
    public function index()
    {
        $piutangs = PiutangBuy::where('status', '0')->with('pemasok')->paginate(10);
        
        return view('admin.purchase.piutang.index', compact('piutangs'));
    }
}
