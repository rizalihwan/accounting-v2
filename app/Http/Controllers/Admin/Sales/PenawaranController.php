<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PenawaranSale as AppPenawaranSale;
use App\Http\Requests\Admin\PenawaranSaleRequest;
use App\Models\Kontak;
use App\Models\Product;
use App\Models\Sale\PenawaranSale;
use App\Models\Sale\PenawaranSaleDetail;
use Illuminate\Http\Request;
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
        $penawarans = PenawaranSale::select('id','tanggal', 'kode', 'pelanggan_id', 'total', 'status')
                        ->with('pelanggan')
                        ->paginate(5);
        return view('admin.sales.penawaran.index', compact('penawarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::select('id', 'name', 'price_sell', 'unit_id')->with('unit:name')->get();
        
        return view('admin.sales.penawaran.create', [
            'kode' => $this->kode,
            'product' => $product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenawaranSaleRequest $request)
    {
        $input = $request->except('_token');

        try {
            $penawarans = PenawaranSale::create([
                'kode' => $input['kode'],
                'tanggal' => $input['tanggal'],
                'pelanggan_id' => $input['pelanggan_id'],
                'total' => $input['total'],
                
            ]);

            foreach ($input['penawarans'] as $input_penawaran) {
                PenawaranSaleDetail::create([
                    'penawaran_id' => $penawarans->id,
                    'product_id' => $input_penawaran['product_id'],
                    'jumlah' => $input_penawaran['jumlah'],
                ]);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Penawaran tidak Tersimpan!' . $e->getMessage());
        }

        return redirect()->route('admin.penawaran.index')->with('success', 'Penawaran berhasil Tersimpan');
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
        $penawarans = PenawaranSale::findOrFail($id);
        $penawarans->delete();

        return redirect()->route('admin.penawaran.index')->with('success', 'Penawaran berhasil Dihapus');
    }

}
