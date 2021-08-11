<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Kontak;
use App\Models\Product;
use App\Models\Sale\FakturSale;
use App\Models\Sale\FakturSaleDetail;
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
        $contacts = Kontak::select('id', 'nama', 'email', 'nik', 'telepon', 'pelanggan')
            ->where('pelanggan', 1)
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

    public function pelangganSelected(Kontak $kontak)
    {
        return [
            "id" => $kontak->id,
            "text" => $kontak->nama,
            "nama" => $kontak->nama,
            "email" => $kontak->email,
            "telepon" => $kontak->telepon
        ];
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

        $penawarans = PenawaranSale::select('id', 'kode', 'pelanggan_id', 'total')
            ->with('pelanggan:id,nama')
            ->where('status', '1')
            ->orWhere('kode', 'like', "%{$search}%")
            ->get()
            ->take(5);

        $result = [];

        foreach ($penawarans as $penawaran) {
            $detail = PenawaranSaleDetail::select('id', 'penawaran_id', 'product_id', 'jumlah', 'satuan', 'harga', 'total')
                ->where('penawaran_id', $penawaran->id)
                ->get();
            $result[] = [
                "id" => $penawaran->id,
                "text" => $penawaran->kode,
                "total" => $penawaran->total,
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

    public function getFakturDetails($faktur_id)
    {
        $details = FakturSaleDetail::select('id', 'faktur_id', 'product_id', 'satuan', 'harga', 'jumlah', 'total')
            ->where('faktur_id', $faktur_id)->get();

        if ($details->count() == 0) {
            return response()->json([
                'message' => 'not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Success get faktur_details data',
            'data' => $details,
            'length' => $details->count()
        ]);
    }

    public function getAkun(Request $request)
    {
        $search = $request->search;
        $akuns = Akun::select('id', 'name', 'kode')
            ->where('name', 'like', "%{$search}%")
            ->orWhere('kode', 'like', "%{$search}%")
            ->orderBy('name', 'ASC')->get()->take(20);

        $result = [];

        foreach ($akuns as $akun) {
            $result[] = [
                "id" => $akun->id,
                "text" => $akun->name,
                "name" => $akun->name,
                "kode" => $akun->kode,
            ];
        }

        return $result;
    }

    public function getFaktur(Request $request)
    {
        $search = $request->search;
        $fakturs = FakturSale::select('id', 'kode', 'total')
            ->where('status', '0')
            ->where('kode', 'like', "%{$search}%")
            ->get()->take(20);

        $result = [];

        foreach ($fakturs as $faktur) {
            $result[] = [
                "id" => $faktur->id,
                "text" => $faktur->kode,
                "total" => $faktur->total,
                "kode" => $faktur->kode,
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
