<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\Purchase\PenawaranBuys;
use App\Models\Purchase\PenawaranBuysDetail;
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

    public function getPenawaran(Request $request)
    {
        $search = $request->search;

        $penawarans = PenawaranBuys::select('id', 'kode', 'pemasok_id', 'total')
            ->with('pemasok:id,nama')
            ->where('status', '1')
            ->orWhere('kode', 'like', "%{$search}%")
            ->get()
            ->take(5);

        $result = [];

        foreach ($penawarans as $penawaran) {
            $detail = PenawaranBuysDetail::select('id', 'penawaran_id', 'product_id', 'jumlah', 'harga_satuan','satuan','total')
                ->where('penawaran_id', $penawaran->id)
                ->get();
            $result[] = [
                "id" => $penawaran->id,
                "text" => $penawaran->kode,
                "total" => $penawaran->total,
                "pemasok" => $penawaran->pemasok->nama,
                "detail" => $detail->toArray(),
            ];
        }

        return $result;
    }

    public function getPesanan(Request $request)
    {
        $search = $request->search;

        $pesanans = PesananSale::select('id', 'kode', 'pelanggan_id')
            ->with('pelanggan:id,nama')
            ->where('status', '1')
            ->orWhere('kode', 'like', "%{$search}%")
            ->get()
            ->take(5);

        $result = [];

        foreach ($pesanans as $pesanan) {
            $detail = PesananSaleDetail::select('id', 'pesanan_id', 'product_id', 'satuan', 'harga', 'jumlah', 'total')
                ->where('pesanan_id', $pesanan->id)
                ->get();
            $result[] = [
                "id" => $pesanan->id,
                "text" => $pesanan->kode,
                "pelanggan" => $pesanan->pelanggan->nama,
                "detail" => $detail->toArray(),
            ];
        }
        return $result;
    }
}
