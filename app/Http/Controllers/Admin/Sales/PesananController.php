<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sale\PenawaranSale;
use App\Models\Sale\PesananSale;
use App\Models\Sale\PesananSaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $pesanans = PesananSale::select('id', 'tanggal', 'kode', 'total', 'status', 'pelanggan_id')->with('pelanggan:id,nama');

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
        $penawaran = PenawaranSale::count() >= 1 ? true : false;
        return view('admin.sales.pesanan.create', [
            'kode' => $this->kode,
            'penawaran' => $penawaran,
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
            'kode' => 'required',
            'tanggal' => 'required|date|date_format:Y-m-d',
            'penawaran_id' => 'required|exists:penawaran_sales,id',
            'pesanans.*.product_id' => 'required|exists:products,id',
            'pesanans.*.jumlah' => 'required|numeric',
            'pesanans.*.satuan' => 'required',
            'pesanans.*.harga' => 'required',
            'pesanans.*.total' => 'required',
            'total' => 'required'
        ]);

        if ($error->fails()) {
            return redirect()->back()->withErrors($error);
        }

        try {
            DB::transaction(function () use ($request) {
                $pesanans = PesananSale::create(array_merge($request->except('pesanans', 'total'), [
                    'total' => preg_replace('/[^\d.]/', '', $request->total),
                ]));

                foreach ($request->pesanans as $pesanan) {
                    PesananSaleDetail::create([
                        'pesanan_id' => $pesanans->id,
                        'product_id' => $pesanan['product_id'],
                        'satuan' => $pesanan['satuan'],
                        'harga' => preg_replace('/[^\d.]/', '', $pesanan['harga']),
                        'jumlah' => $pesanan['jumlah'],
                        'total' => preg_replace('/[^\d.]/', '', $pesanan['total']),
                    ]);
                }
            });

            return redirect()->route('admin.sales.pesanan.index')->with('success', 'Pesanan berhasil Tersimpan');
        } catch (\Exception $e) {
            return back()->with('error', 'Pesanan tidak Tersimpan!' . $e->getMessage());
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
        $pesanan = PesananSale::with('pelanggan:id,nama,kode_kontak', 'penawaran:id,kode', 'pesanan_details')
            ->findOrFail($id);

        if (empty($pesanan)) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        return view('admin.sales.pesanan.edit', compact('pesanan'));
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

        return redirect()->back()->with('success', 'Pesanan berhasil Dihapus');
    }
}
