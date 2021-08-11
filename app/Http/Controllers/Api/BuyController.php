<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\Product;
use App\Models\Purchase\FakturBuy;
use App\Models\Purchase\FakturBuyDetail;
use App\Models\Purchase\PenawaranBuys;
use App\Models\Purchase\PenawaranBuysDetail;
use App\Models\Purchase\PengirimanBuysDetail;
use App\Models\Purchase\PesananBuys;
use App\Models\Purchase\PesananBuysDetail;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function getProduct(Request $request)
    {
        $search = $request->search;

        $products = Product::select('id', 'unit_id', 'name', 'price_buy', 'status')
            ->with('unit:id,name,status')
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
                "price_buy" => $product->price_buy,
            ];
        }

        return $result;
    }

    public function selectedProduct(Product $product)
    {
        return response()->json([
            "id" => $product->id,
            "text" => $product->name,
            "unit" => $product->unit->name,
            "price_buy" => $product->price_buy,
        ]);
    }
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
            $detail = PenawaranBuysDetail::select('id', 'penawaran_id', 'product_id', 'jumlah', 'harga', 'satuan', 'total')
                ->where('penawaran_id', $penawaran->id)
                ->get();
            $result[] = [
                "id" => $penawaran->id,
                "text" => $penawaran->kode,
                "total" => $penawaran->total,
                "pemasok" => $penawaran->pemasok->nama,
                "detail" => $detail,
            ];
        }

        return response()->json($result);
    }

    public function getPesanan(Request $request)
    {
        $search = $request->search;

        $pesanans = PesananBuys::select('id', 'kode', 'pemasok_id')
            ->with('pemasok:id,nama')
            ->where('status', '1')
            ->orWhere('kode', 'like', "%{$search}%")
            ->get()
            ->take(5);

        $result = [];

        foreach ($pesanans as $pesanan) {
            $detail = PesananBuysDetail::select('id', 'pesanan_id', 'product_id', 'satuan', 'harga', 'jumlah', 'total')
                ->where('pesanan_id', $pesanan->id)
                ->get();
            $result[] = [
                "id" => $pesanan->id,
                "text" => $pesanan->kode,
                "pemasok" => $pesanan->pemasok->nama,
                "detail" => $detail->toArray(),
            ];
        }
        return $result;
    }

    public function getFaktur(Request $request)
    {
        $search = $request->search;
        $fakturs = FakturBuy::select('id', 'kode', 'total')
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


    public function getPenawaranDetails($penawaran_id)
    {
        $details = PenawaranBuysDetail::select('id', 'penawaran_id', 'product_id', 'satuan', 'harga', 'jumlah', 'total')
            ->where('penawaran_id', $penawaran_id)->get();

        if ($details->count() == 0) {
            return response()->json([
                'message' => 'not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Success get penawaran_details data',
            'data' => $details,
            'length' => $details->count()
        ]);
    }

    public function getPesananDetails($pesanan_id)
    {
        $details = PesananBuysDetail::select('id', 'pesanan_id', 'product_id', 'jumlah', 'satuan', 'harga', 'total')
            ->where('pesanan_id', $pesanan_id)->with('product')->get();

        if ($details->count() == 0) {
            return response()->json([
                'message' => 'detail not found',
                'data' => [],
                'length' => 0
            ], 404);
        }

        return response()->json([
            'message' => "Success get pesanan_details data",
            'data' => $details,
            'length' => $details->count()
        ]);
    }

    public function getPenerimaanDetails($terima_id)
    {
        $details = PengirimanBuysDetail::select('id', 'terima_id', 'product_id', 'jumlah', 'satuan', 'harga', 'total')
            ->where('terima_id', $terima_id)->get();

        if ($details->count() == 0) {
            return response()->json([
                'message' => 'detail not found',
                'data' => [],
                'length' => 0
            ], 404);
        }

        return response()->json([
            'message' => "Success get penerimaan_details data",
            'data' => $details,
            'length' => $details->count()
        ]);
    }

    public function getFakturDetails($faktur_id)
    {
        $details = FakturBuyDetail::select('id', 'faktur_id', 'product_id', 'jumlah', 'satuan', 'harga', 'total')
            ->where('faktur_id', $faktur_id)->get();

        if ($details->count() == 0) {
            return response()->json([
                'message' => 'detail not found',
                'data' => [],
                'length' => 0
            ], 404);
        }

        return response()->json([
            'message' => "Success get faktur_details data",
            'data' => $details,
            'length' => $details->count()
        ]);
    }
}
