<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function getPemasok(Request $request)
    {
        $search = $request->search;
        $contacts = Kontak::select('id', 'nama', 'email', 'nik', 'telepon', 'pemasok')
            ->where('pemasok', 1)
            ->where(function ($query) use ($search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('telepon', 'like', "%{$search}%");
            })->orderBy('nama')->get()->take(20);

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

    public function pemasokSelected(Kontak $kontak)
    {
        return [
            "id" => $kontak->id,
            "text" => $kontak->nama,
            "nama" => $kontak->nama,
            "email" => $kontak->email,
            "telepon" => $kontak->telepon
        ];
    }
}
