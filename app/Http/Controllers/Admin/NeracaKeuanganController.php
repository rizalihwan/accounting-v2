<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NeracaKeuangan;
use DataTables;
class NeracaKeuanganController extends Controller
{
    public function index()
    {
        return view('admin.neracakeuangan.index');
    }
    public function get_data()
    {
        $data = NeracaKeuangan::all();

        return DataTables::of($data)->make(true);
    }
    public function show()
    {
        if(request()->check)
        {
            return view('admin.neracakeuangan.show', [
                'date' => request()->date
            ]);
        }
        else
        {
            return view('admin.neracakeuangan.show', [
                'date' => request()->date
            ]);
        }
    }
}
