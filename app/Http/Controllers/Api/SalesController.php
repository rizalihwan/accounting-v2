<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function getPelanggan(Request $request)
    {
        $search = $request->search;
        $contacts = Kontak::select('id', 'nama', 'email', 'nik', 'telepon')
            ->where('pelanggan', TRUE)
            ->orwhere('nama', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('nik', 'like', "%{$search}%")
            ->orWhere('telepon', 'like', "%{$search}%")
            ->orderBy('nama', 'ASC')->get()->take(20);

        $result = [];

        foreach ($contacts as $kontak) {
            $result[] = [
                "id" => $kontak->id,
                "text" => $kontak->nama,
                "nama" => $kontak->nama,
                "email" => $kontak->email,
                "telepon" => $kontak->telepon
            ];
        }

        return $result;
    }

    public function pelangganSelected()
    {

    }
}
