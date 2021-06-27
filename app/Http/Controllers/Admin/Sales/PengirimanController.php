<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PengirimanSaleRequest;
use App\Models\Product;
use App\Models\Sale\PengirimanSale;
use App\Models\Sale\PengirimanSaleDetail;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    private $kode;

    public function __construct()
    {
        $number = PengirimanSale::count();
        if ($number > 0) {
            $number = PengirimanSale::max('kode');
            $strnum = (int)substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'PP' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'PP' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'PP' . "00" . $strnum;
            }
        } else {
            $kode = 'PP' . "001";
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
        $pengirmans = PengirimanSale::select('id','tanggal', 'kode', 'total','status', 'pelanggan_id')->with('pelanggan:id,nama');

        return view('admin.sales.pengiriman.index', [
            'pengirimans' => $pengirmans->paginate(5),
            'countPengiriman' => $pengirmans->count(),
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
        return view('admin.sales.pengiriman.create', [
            'kode' => $this->kode,
            'product' => $product,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengirimanSaleRequest $request)
    {
        try {

            $pengiriman = PengirimanSale::create($request->except('pengirimans'));

            foreach ($request->pengirimans as $input_pengiriman) {
                PengirimanSaleDetail::create([
                    'pengiriman_id' => $pengiriman->id,
                    'product_id' => $input_pengiriman['product_id'],
                    'jumlah' => $input_pengiriman['jumlah'],
                ]);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Pengiriman tidak Tersimpan!' . $e->getMessage());
        }

        return redirect()->route('admin.pengiriman.index')->with('success', 'Pengiriman berhasil Tersimpan');
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
        $pesanans = PengirimanSale::findOrFail($id);
        $pesanans->delete();

        return redirect()->route('admin.pengiriman.index')->with('success', 'Pengiriman berhasil Dihapus');
    }
}