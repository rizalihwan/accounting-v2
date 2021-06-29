<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Kontak;
use App\Models\Product;
use App\Models\Sale\PenawaranSale;
use App\Models\Sale\PenawaranSaleDetail;
use App\Models\Sale\PesananSale;
use App\Models\Sale\PesananSaleDetail;
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

    public function getProduct(Request $request)
    {
        $search = $request->search;

        $products = Product::select('id', 'unit_id', 'name', 'price_sell', 'status')
            ->with('unit')
            ->where('status', '1')
            ->orWhere('name', 'like', "%{$search}%")
            ->get()
            ->take(5);

        $result = [];

        foreach ($products as $product) {
            $result[] = [
                "id" => $product->id,
                "text" => $product->name,
                "unit" => $product->unit->name,
                "price_sell" => $product->price_sell,
            ];
        }

        return $result;
    }

    public function getPenawaran(Request $request)
    {
        $search = $request->search;

        $penawarans = PenawaranSale::select('id', 'kode', 'pelanggan_id')
            ->with('pelanggan:id,nama')
            ->where('status', '1')
            ->orWhere('kode', 'like', "%{$search}%")
            ->get()
            ->take(5);

        $result = [];

        foreach ($penawarans as $penawaran) {
            $detail = PenawaranSaleDetail::select('id', 'penawaran_id', 'product_id', 'jumlah')
                ->where('penawaran_id', $penawaran->id)
                ->get();
            $result[] = [
                "id" => $penawaran->id,
                "text" => $penawaran->kode,
                "pelanggan" => $penawaran->pelanggan->nama,
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
            $detail = PesananSaleDetail::select('id', 'pesanan_id', 'product_id', 'jumlah')
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

    /**
     * Selected data
     */

    public function selectedProduct(Product $product)
    {
        return response()->json([
            "id" => $product->id,
            "text" => $product->name,
            "unit" => $product->unit->name,
            "price_sell" => $product->price_sell,
        ]);
    }
}
