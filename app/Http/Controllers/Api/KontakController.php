<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    private $kontak;

    public function __construct()
    {
        $this->kontak = new Kontak();
    }

    // SELECT2
    public function getNasabah(Request $request)
    {
        $search = $request->search;
        $data = $this->kontak->where('nasabah', true)
            ->where(function ($q) use ($search) {
                return $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })->get();

        $results = [];
        foreach ($data as $kontak) {
            $kode = $kontak->kode_kontak ?? ' - ';
            $results[] = [
                'id' => $kontak->id,
                'text' => "{$kontak->nama} ({$kode})",
                'nama' => $kontak->nama,
                'alamat' => $kontak->alamat,
                'pekerjaan' => $kontak->pekerjaan,
            ];
        }

        return $results;
    }

    public function getPetugas(Request $request)
    {
        $search = $request->search;
        $data = $this->kontak->where('petugas', true)
            ->where(function ($q) use ($search) {
                return $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })->get();

        $results = [];
        foreach ($data as $kontak) {
            $kode = $kontak->kode_kontak ?? ' - ';
            $results[] = [
                'id' => $kontak->id,
                'text' => "{$kontak->nama} ({$kode})",
                'nama' => $kontak->nama,
            ];
        }

        return $results;
    }

    public function selectedKontak($id)
    {
        $kontak = $this->kontak->find($id);
        $kode = $kontak->kode_kontak ?? ' - ';

        return [
            'id' => $kontak->id,
            'text' => "{$kontak->nama} ({$kode})",
            'nama' => $kontak->nama,
            'alamat' => $kontak->alamat,
            'pekerjaan' => $kontak->pekerjaan,
        ];
    }
}
