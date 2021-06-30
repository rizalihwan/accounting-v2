<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FakturSaleRequest;
use App\Models\Sale\FakturSale;
use App\Models\Sale\FakturSaleDetail;
use Illuminate\Http\Request;

class FakturController extends Controller
{
    public function __construct()
    {
        $number = FakturSale::count();
        if ($number > 0) {
            $number = FakturSale::max('kode');
            $strnum = substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'PF' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'PF' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'PF' . "00" . $strnum;
            }
        } else {
            $kode = 'PF' . "001";
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
        $fakturs = FakturSale::select('id','tanggal', 'kode', 'pelanggan_id', 'total', 'status')
        ->with('pelanggan')
        ->paginate(5);

        return view('admin.sales.faktur.index', compact('fakturs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sales.faktur.create', [
            'kode' => $this->kode,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FakturSaleRequest $request)
    {
        try {

            $fakturs = FakturSale::create(array_merge($request->except('fakturs', 'total'),[
                'total' => preg_replace('/[^\d.]/', '', $request->total),
            ]));

            foreach ($request->fakturs as $faktur) {
                FakturSaleDetail::create([
                    'faktur_id' => $fakturs->id,
                    'product_id' => $faktur['product_id'],
                    'satuan' => $faktur['satuan'],
                    'harga' => preg_replace('/[^\d.]/', '', $faktur['harga']),
                    'jumlah' => $faktur['jumlah'],
                    'total' => preg_replace('/[^\d.]/', '', $faktur['total']),
                ]);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Faktur tidak Tersimpan!' . $e->getMessage());
        }

        return back()->with('success', 'Faktur berhasil Tersimpan');
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
        $fakturs = FakturSale::findOrFail($id);
        $fakturs->delete();

        return redirect()->back()->with('success', 'Faktur berhasil Dihapus');
    }
}
