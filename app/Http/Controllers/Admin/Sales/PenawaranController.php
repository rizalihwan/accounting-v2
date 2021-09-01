<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sale\PenawaranSale;
use App\Models\Sale\PenawaranSaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenawaranController extends Controller
{
    private $kode;

    public function __construct()
    {
        $number = PenawaranSale::count();
        if ($number > 0) {
            $number = PenawaranSale::max('kode');
            $strnum = substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'PS' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'PS' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'PS' . "00" . $strnum;
            }
        } else {
            $kode = 'PS' . "001";
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
        $penawarans = PenawaranSale::select('id', 'tanggal', 'kode', 'pelanggan_id', 'total', 'status')->with('pelanggan');
        return view('admin.sales.penawaran.index', [
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
        return view('admin.sales.penawaran.create', [
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
                $penawaran = PenawaranSale::create(array_merge($request->except('penawarans', 'total'), [
                    'total' => preg_replace('/[^\d.]/', '', $request->total),
                ]));

                foreach ($request->penawarans as $detail) {
                    unset($detail['id']); // Hapus elemen gak kepake

                    PenawaranSaleDetail::create([
                        'penawaran_id' => $penawaran->id,
                        'product_id' => $detail['product_id'],
                        'satuan' => $detail['satuan'],
                        'harga' => preg_replace('/[^\d.]/', '', $detail['harga']),
                        'jumlah' => $detail['jumlah'],
                        'total' => preg_replace('/[^\d.]/', '', $detail['total']),
                    ]);
                }
            });

            return redirect()->route('admin.sales.penawaran.index')->with('success', 'Penawaran berhasil Tersimpan');
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
        $penawaran = PenawaranSale::with('penawaran_details.product', 'pelanggan')->findOrFail($id);

        return view('admin.sales.penawaran.show', compact('penawaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PenawaranSale $penawaran)
    {
        $penawaran_details = PenawaranSaleDetail::where('penawaran_id', $penawaran->id)->get();
        return view('admin.sales.penawaran.edit', compact('penawaran', 'penawaran_details'));
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
        $req = $request->except('_token', '_method');

        $error = Validator::make($req, [
            'pelanggan_id' => 'required|exists:kontaks,id',
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
            DB::transaction(function () use ($request, $req, $id) {
                $penawaran = PenawaranSale::find($id);

                if (empty($penawaran)) {
                    return redirect()->route('admin.sales.penawaran.index')
                        ->with('error', "Penawaran tidak ditemukan.");
                }

                $penawaran->update(
                    array_merge($request->except('_token', '_method', 'penawarans', 'total'), [
                        'total' => preg_replace('/[^\d.]/', '', $request->total),
                    ])
                );

                $product_id = [];

                foreach ($req['penawarans'] as $value) {
                    $product_id[] = $value['id'];
                }

                $penawarans = array_values(array_filter($product_id, fn ($value) => is_null($value) && $value == ''));
                $product_id = array_filter($product_id, fn ($value) => !is_null($value) && $value !== '');

                PenawaranSaleDetail::exclude(['created_at', 'updated_at'])
                    ->where('penawaran_id', $id)
                    ->whereNotIn('id', $product_id)
                    ->delete();

                foreach ($req['penawarans'] as $item) {
                    if ($item['id'] != null) {
                        PenawaranSaleDetail::where('id', $item['id'])->update([
                            'product_id' => $item['product_id'],
                            'satuan' => $item['satuan'],
                            'harga' => preg_replace('/[^\d.]/', '', $item['harga']),
                            'jumlah' => $item['jumlah'],
                            'total' => preg_replace('/[^\d.]/', '', $item['total']),
                        ]);
                    } else {
                        PenawaranSaleDetail::create([
                            'penawaran_id' => $id,
                            'product_id' => $item['product_id'],
                            'satuan' => $item['satuan'],
                            'harga' => preg_replace('/[^\d.]/', '', $item['harga']),
                            'jumlah' => $item['jumlah'],
                            'total' => preg_replace('/[^\d.]/', '', $item['total']),
                        ]);
                    }
                }
            });

            return redirect()->route('admin.sales.penawaran.index')->with('success', 'Penawaran berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', "Penawaran gagal diupdate! \n" . $e->getMessage());
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
        $penawarans = PenawaranSale::findOrFail($id);
        $penawarans->delete();

        return redirect()->back()->with('success', 'Penawaran berhasil Dihapus');
    }
}
