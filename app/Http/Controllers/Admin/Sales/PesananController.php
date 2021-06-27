<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PesananSaleRequest;
use App\Models\Product;
use App\Models\Sale\PenawaranSale;
use App\Models\Sale\PesananSale;
use App\Models\Sale\PesananSaleDetail;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    private $kode;

    public function __construct()
    {
        $number = PesananSale::count();
        if ($number > 0) {
            $number = PesananSale::max('kode');
            $strnum = (int)substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'PN' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'PN' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'PN' . "00" . $strnum;
            }
        } else {
            $kode = 'PN' . "001";
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
        $pesanans = PesananSale::select('id','tanggal', 'kode', 'total','status', 'pelanggan_id')->with('pelanggan:id,nama');

        return view('admin.sales.pesanan.index', [
            'pesanans' => $pesanans->paginate(5),
            'countPesanan' => $pesanans->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::select('id', 'name', 'price_sell', 'unit_id')->with('unit:name')->get();
        $penawaran = PenawaranSale::count() >= 1 ? true : false;
        return view('admin.sales.pesanan.create', [
            'kode' => $this->kode,
            'product' => $product,
            'penawaran' => $penawaran,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PesananSaleRequest $request)
    {
        try {

            $pesanans = PesananSale::create($request->except('pesanans'));

            foreach ($request->pesanans as $input_pesanan) {
                PesananSaleDetail::create([
                    'pesanan_id' => $pesanans->id,
                    'product_id' => $input_pesanan['product_id'],
                    'jumlah' => $input_pesanan['jumlah'],
                ]);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Pesanan tidak Tersimpan!' . $e->getMessage());
        }

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $pesanans = PesananSale::findOrFail($id);
        $pesanans->delete();

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil Dihapus');
    }
}