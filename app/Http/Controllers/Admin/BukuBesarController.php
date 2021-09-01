<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    public function index()
    {

        return view('admin.bukubesar.index', [
            'kontak' => Akun::get(),
            'akun' => null,
            'select' => Akun::get(),
            'ada' => 'ada'
        ]);
    }

    public function cariakun(Request $request)
    {

        return view('admin.bukubesar.index', [
            'kontak' => Akun::where('id',$request->id)->get(),
            'akun' => Akun::where('id',$request->id)->get(),
            'select' => Akun::get(),
            'ada' => 'ada'
        ]);
    }
}
