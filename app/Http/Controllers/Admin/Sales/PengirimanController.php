<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sale\PengirimanSale;
use App\Models\Sale\PengirimanSaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $pengirmans = PengirimanSale::select('id', 'tanggal', 'kode', 'total', 'status', 'pelanggan_id')->with('pelanggan:id,nama');

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
        return view('admin.sales.pengiriman.create', [
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
            'pelanggan_id' => 'required|exists:kontaks,id',
            'pesanan_id' => 'exists:pesanan_sales,id',
            'tanggal' => 'required|date|date_format:Y-m-d',
            'pengirimans.*.product_id' => 'required|exists:products,id',
            'pengirimans.*.jumlah' => 'required|numeric',
            'pengirimans.*.satuan' => 'required',
            'pengirimans.*.harga' => 'required',
            'pengirimans.*.total' => 'required',
            'total' => 'required',
        ]);

        if ($error->fails()) {
            return redirect()->back()->withErrors($error);
        }

        try {
            DB::transaction(function () use ($request) {
                $pengirimans = PengirimanSale::create(
                    array_merge(
                        $request->except('pengirimans', 'total'),
                        [
                            'total' => preg_replace('/[^\d.]/', '', $request->total)
                        ]
                    )
                );

                foreach ($request->pengirimans as $pengiriman) {
                    PengirimanSaleDetail::create([
                        'pengiriman_id' => $pengirimans->id,
                        'product_id' => $pengiriman['product_id'],
                        'satuan' => $pengiriman['satuan'],
                        'harga' => preg_replace('/[^\d.]/', '', $pengiriman['harga']),
                        'jumlah' => $pengiriman['jumlah'],
                        'total' => preg_replace('/[^\d.]/', '', $pengiriman['total']),
                    ]);
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('admin.sales.pengiriman.index')->with('success', 'Pengiriman berhasil Tersimpan');
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

        return redirect()->back()->with('success', 'Pengiriman berhasil Dihapus');
    }
}
