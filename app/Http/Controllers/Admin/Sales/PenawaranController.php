<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\Product;
use App\Models\Sale\PenawaranSale;
use Illuminate\Http\Request;

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
        $penawarans = PenawaranSale::select('tanggal', 'kode', 'pelanggan_id', 'total', 'status')
                        ->with('pelanggan:nama')
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
        $pelanggan = Kontak::select('id','nama', 'pelanggan')
                    ->where('pelanggan', TRUE)
                    ->get();
        $product = Product::select('id', 'name', 'price_sell', 'unit_id')->with('unit:name')->get();
        
        return view('admin.sales.penawaran.create', [
            'kode' => $this->kode,
            'pelanggan' => $pelanggan,
            'product' => $product
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
        //
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
        //
    }

}
