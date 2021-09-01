<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Models\Product;
use App\Models\Purchase\PesananBuys;
use App\Models\Purchase\PenawaranBuys;
use App\Models\Purchase\PesananBuysDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PesananbuyController extends Controller
{
    private $kode;

    public function __construct()
    {
        $number = PesananBuys::count();
        if ($number > 0) {
            $number = PesananBuys::max('kode');
            $strnum = (int)substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'PX' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'PX' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'PX' . "00" . $strnum;
            }
        } else {
            $kode = 'PX' . "001";
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
        $pesanans = PesananBuys::select('id', 'tanggal', 'kode', 'total', 'status', 'pemasok_id')->with('pemasok:id,nama');

        return view('admin.purchase.pemesanan.index', [
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
        $penawaran = PenawaranBuys::count() >= 1 ? true : false;

        return view('admin.purchase.pemesanan.create', [
            'kode' => $this->kode,
            'penawaran' => $penawaran
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
            'penawaran_id' => 'required|exists:penawaran_buys,id',
            'kode' => 'required',
            'tanggal' => 'required|date|date_format:Y-m-d',
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
                $pesanan = PesananBuys::create(array_merge($request->except('pesanans', 'total'), [
                    'total' => preg_replace('/[^\d.]/', '', $request->total),
                ]));
                $penawaran = PenawaranBuys::findOrFail($request->penawaran_id);
                $penawaran->update([
                    'status' => '0'
                ]);

                foreach ($request->pesanans as $detail) {
                    unset($detail['id']); // Hapus elemen gak kepake

                    PesananBuysDetail::create([
                        'pesanan_id' => $pesanan->id,
                        'product_id' => $detail['product_id'],
                        'satuan' => $detail['satuan'],
                        'harga' => preg_replace('/[^\d.]/', '', $detail['harga']),
                        'jumlah' => $detail['jumlah'],
                        'total' => preg_replace('/[^\d.]/', '', $detail['total']),
                    ]);
                }
            });

            return redirect()->route('admin.purchase.pesanan.index')->with('success', 'Pesanan berhasil Tersimpan');
        } catch (\Exception $e) {
            return back()->with('error', 'Penawaran tidak Tersimpan!' . $e->getMessage());
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
        $pesanan = PesananBuys::with('pesanan_details.product', 'pemasok')->findOrFail($id);
        return view('admin.purchase.pemesanan.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pesanan = PesananBuys::with('pemasok:id,nama,kode_kontak', 'penawaran:id,kode')
            ->find($id);

        if (empty($pesanan)) {
            return redirect()->route('admin.purchase.pesanan.index')
                ->with('error', 'Pesanan tidak ditemukan');
        }

        return view('admin.purchase.pemesanan.edit', compact('pesanan'));
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
        $validation = Validator::make($request->all(), [
            'pesanans.*.product_id' => 'required|exists:products,id',
            'pesanans.*.jumlah' => 'required|numeric',
            'pesanans.*.satuan' => 'required',
            'pesanans.*.harga' => 'required',
            'pesanans.*.total' => 'required',
            'total' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $pesanan = PesananBuys::find($id);
        if (empty($pesanan)) {
            return redirect()->route('admin.purchase.pesanan.index')
                ->with('error', 'Pesanan tidak ditemukan');
        }

        try {
            DB::transaction(function () use ($request, $id, $pesanan) {
                $detail_id = [];

                foreach ($request->pesanans as $value) {
                    $detail_id[] = $value['id'];
                }

                $detail_id = array_filter($detail_id, fn ($value) => !is_null($value) && $value !== '');
                PesananBuysDetail::where('pesanan_id', $id)
                    ->whereNotIn('id', $detail_id)
                    ->delete();

                foreach ($request->pesanans as $item) {
                    if ($item['id'] != null) {
                        PesananBuysDetail::where('id', $item['id'])->update([
                            'product_id' => $item['product_id'],
                            'jumlah' => $item['jumlah'],
                            'satuan' => $item['satuan'],
                            'harga' => preg_replace('/[^\d.]/', '', $item['harga']),
                            'total' => preg_replace('/[^\d.]/', '', $item['total']),
                        ]);
                    } else {
                        PesananBuysDetail::create([
                            'pesanan_id' => $id,
                            'product_id' => $item['product_id'],
                            'jumlah' => $item['jumlah'],
                            'satuan' => $item['satuan'],
                            'harga' => preg_replace('/[^\d.]/', '', $item['harga']),
                            'total' => preg_replace('/[^\d.]/', '', $item['total']),
                        ]);
                    }
                }

                $pesanan->update(array_merge($request->except('pesanans', 'total'), [
                    'total' => preg_replace('/[^\d.]/', '', $request->total)
                ]));
            });

            return redirect()->route('admin.purchase.pesanan.index')
                ->with('success', 'Pesanan berhasil diedit');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pesananas = PesananBuys::findOrFail($id);
        $pesananas->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil Dihapus');
    }
}
