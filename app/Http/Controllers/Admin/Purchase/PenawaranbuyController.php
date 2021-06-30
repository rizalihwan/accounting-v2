<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Models\Buy;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\Purchase\PenawaranBuys;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PenawaranbuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indeks = PenawaranBuys::all();
        return view('admin.purchase.penawaran.index',compact('indeks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pemasok = Kontak::all();
        $produk = Product::all();
        return view('admin.purchase.penawaran.create',compact('pemasok','produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imam = count($request->invoice);
        
        $jml=0;
        DB::table('penawaran_buys')->insert([
            'tanggal' => $request->tanggal,
            'pemasok_id' =>$request->pemasok,
            'desc' => $request->Deskripsi,
            'status' => 1,
        ]);
        $id = DB::table('penawaran_buys')->select('id')
                              ->orderByDesc('id')
                              ->first();
        for ($i=0; $i < $imam; $i++) { 
            DB::table('penawaran_buy_details')->insert([
                'penawaran_id'=> $id->id,
                'product_id'=> $request->invoice[$i]["produk"],
                'jumlah'=> $request->invoice[$i]["jumlah"],
                'satuan'=> $request->invoice[$i]["satuan"],
                'harga_satuan'=> $request->invoice[$i]["harga_satuan"],
                'total'=> $request->invoice[$i]["total"],
            ]);
            $jml = $jml + $request->invoice[$i]["jumlah"];
        }
        DB::table('penawaran_buys')->where('id',$id->id)->update([
            'total' => $jml
        ]);
        return redirect()->route('admin.penawaran.index')->with('success', 'Penawaran Pembelian berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Product::all();
        $pemasok = Kontak::all();
        return view('admin.purchase.penawaran.'.$id,compact('pemasok','produk'));
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
