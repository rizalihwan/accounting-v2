<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase\PengirimanBuys;
use App\Models\Purchase\PengirimanBuysDetail;
use App\Models\Purchase\PesananBuys;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class TerimabuyController extends Controller
{
    private $kode;

    public function __construct()
    {
        $number = PengirimanBuys::count();
        if ($number > 0) {
            $number = PengirimanBuys::max('kode');
            $strnum = (int)substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'PT' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'PT' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'PT' . "00" . $strnum;
            }
        } else {
            $kode = 'PT' . "001";
        }
        $this->kode = $kode;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penerimaans = PengirimanBuys::select('id', 'tanggal', 'kode', 'total', 'status', 'pemasok_id')->with('pemasok:id,nama');

        return view('admin.purchase.penerimaan.index', [
            'penerimaans' => $penerimaans->paginate(5),
            'countPengiriman' => $penerimaans->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.purchase.penerimaan.create', [
            'kode' => $this->kode,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error = Validator::make($request->all(), [
            'pemasok_id' => 'required|exists:kontaks,id',
            'pesanan_id' => 'exists:pesanan_buys,id',
            'tanggal' => 'required|date|date_format:Y-m-d',
            'penerimaans.*.product_id' => 'required|exists:products,id',
            'penerimaans.*.jumlah' => 'required|numeric',
            'penerimaans.*.satuan' => 'required',
            'penerimaans.*.harga' => 'required',
            'penerimaans.*.total' => 'required',
            'total' => 'required',
        ]);

        if ($error->fails()) {
            return redirect()->back()->withErrors($error);
        }

        try {
            DB::transaction(function () use ($request) {
                $penerimaans = PengirimanBuys::create(
                    array_merge(
                        $request->except('penerimaans', 'total'),
                        [
                            'total' => preg_replace('/[^\d.]/', '', $request->total)
                        ]
                    )
                );

                $pesanan = PesananBuys::findOrFail($request->pesanan_id);
                $pesanan->update([
                    'status' => '0'
                ]);

                foreach ($request->penerimaans as $terima) {
                    PengirimanBuysDetail::create([
                        'terima_id' => $penerimaans->id,
                        'product_id' => $terima['product_id'],
                        'satuan' => $terima['satuan'],
                        'harga' => preg_replace('/[^\d.]/', '', $terima['harga']),
                        'jumlah' => $terima['jumlah'],
                        'total' => preg_replace('/[^\d.]/', '', $terima['total']),
                    ]);
                }
            });

            return redirect()->route('admin.purchase.terima.index')->with('success', 'Penerimaan berhasil Tersimpan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Product::all();
        $pemasok = Kontak::all();
        $pesanan = PesananBuys::all();
        return view('admin.purchase.penerimaan.'.$id,compact('produk','pemasok','pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penerimaans = PengirimanBuys::findOrFail($id);
        $penerimaans->delete();

        return redirect()->back()->with('success', 'Pengiriman berhasil Dihapus');
    }
}
