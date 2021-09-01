<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\Purchase\PenawaranBuys;
use App\Models\Purchase\PenawaranBuysDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PenawaranbuyController extends Controller
{
    private $kode;

    public function __construct()
    {
        $number = PenawaranBuys::count();
        if ($number > 0) {
            $number = PenawaranBuys::max('kode');
            $strnum = substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'PB' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'PB' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'PB' . "00" . $strnum;
            }
        } else {
            $kode = 'PB' . "001";
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
        $penawarans = PenawaranBuys::select('id', 'tanggal', 'kode', 'pemasok_id', 'total', 'status')->with('pemasok');
        return view('admin.purchase.penawaran.index', [
            'penawarans' => $penawarans->paginate(5),
            'countPenawaran' => $penawarans->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = $this->kode;
        return view('admin.purchase.penawaran.create', compact('kode'));
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
            'kode' => 'required',
            'tanggal' => 'required|date|date_format:Y-m-d',
            'penawarans.*.product_id' => 'required|exists:products,id',
            'penawarans.*.jumlah' => 'required|numeric',
            'penawarans.*.satuan' => 'required',
            'penawarans.*.harga' => 'required',
            'penawarans.*.total' => 'required',
            'total' => 'required'
        ]);

        if ($error->fails()) {
            return redirect()->back()->withErrors($error);
        }

        try {
            DB::transaction(function () use ($request) {
                $penawaran = PenawaranBuys::create(array_merge($request->except('penawarans', 'total'), [
                    'total' => preg_replace('/[^\d.]/', '', $request->total),
                ]));

                foreach ($request->penawarans as $detail) {
                    unset($detail['id']); // Hapus elemen gak kepake

                    PenawaranBuysDetail::create([
                        'penawaran_id' => $penawaran->id,
                        'product_id' => $detail['product_id'],
                        'satuan' => $detail['satuan'],
                        'harga' => preg_replace('/[^\d.]/', '', $detail['harga']),
                        'jumlah' => $detail['jumlah'],
                        'total' => preg_replace('/[^\d.]/', '', $detail['total']),
                    ]);
                }
            });

            return redirect()->route('admin.purchase.penawaran.index')->with('success', 'Penawaran berhasil Tersimpan');
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
        $penawaran = PenawaranBuys::with('penawaran_details.product', 'pemasok')->findOrFail($id);

        return view('admin.purchase.penawaran.show', compact('penawaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penawaran = PenawaranBuys::find($id);

        if (empty($penawaran)) {
            return redirect()->route('admin.purchase.penawaran.index')
                ->with('error', 'Penawaran tidak ditemukan');
        }

        return view('admin.purchase.penawaran.edit', compact('penawaran'));
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
        $validate = Validator::make($request->all(), [
            'penawarans.*.product_id' => 'required|exists:products,id',
            'penawarans.*.jumlah' => 'required|numeric',
            'penawarans.*.satuan' => 'required',
            'penawarans.*.harga' => 'required',
            'penawarans.*.total' => 'required',
            'total' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $detail_id = [];

        foreach ($request->penawarans as $value) {
            $detail_id[] = $value['id'];
        }

        $detail_id = array_filter($detail_id, fn ($value) => !is_null($value) && $value !== '');

        try {
            DB::transaction(function () use ($request, $id, $detail_id) {
                $penawaran = PenawaranBuys::find($id);

                if (empty($penawaran)) {
                    return redirect()->route('admin.purchase.penawaran.index')
                        ->with('error', 'Penawaran tidak ditemukan.');
                }

                PenawaranBuysDetail::where('penawaran_id', $id)
                    ->whereNotIn('id', $detail_id)
                    ->delete();

                foreach ($request->penawarans as $item) {
                    if ($item['id'] != null) {
                        PenawaranBuysDetail::where('id', $item['id'])->update([
                            'product_id' => $item['product_id'],
                            'satuan' => $item['satuan'],
                            'harga' => preg_replace('/[^\d.]/', '', $item['harga']),
                            'jumlah' => $item['jumlah'],
                            'total' => preg_replace('/[^\d.]/', '', $item['total']),
                        ]);
                    } else {
                        PenawaranBuysDetail::create([
                            'penawaran_id' => $id,
                            'product_id' => $item['product_id'],
                            'satuan' => $item['satuan'],
                            'harga' => preg_replace('/[^\d.]/', '', $item['harga']),
                            'jumlah' => $item['jumlah'],
                            'total' => preg_replace('/[^\d.]/', '', $item['total']),
                        ]);
                    }
                }

                $penawaran->update(array_merge($request->except('penawarans', 'total'), [
                    'total' => preg_replace('/[^\d.]/', '', $request->total)
                ]));
            });

            return redirect()->route('admin.purchase.penawaran.index')
                ->with('success', 'Penawaran berhasil diedit.');
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
        $penawarans = PenawaranBuys::findOrFail($id);
        $penawarans->delete();

        return redirect()->back()->with('success', 'Penawaran berhasil Dihapus');
    }
}
