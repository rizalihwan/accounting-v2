<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Models\Product;
use App\Models\Purchase\PesananBuys;
use App\Models\Purchase\PenawaranBuys;
use Illuminate\Support\Facades\DB;


class TerimabuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indeks = PesananBuys::all();
        return view('admin.purchase.penerimaan.index',compact('indeks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        DB::table('terima_buys')->insert([
            'tanggal' => $request->tanggal,
            'pemasok_id' =>$request->pemasok,
            'no_pesanan' =>$request->no_penawaran,
            'desc' => $request->Deskripsi,
            'status' => '1',
        ]);
        $id = DB::table('terima_buys')->select('id')
                              ->orderByDesc('id')
                              ->first();
        for ($i=0; $i < $imam; $i++) { 
            DB::table('terima_buy_details')->insert([
                'terima_id'=> $id->id,
                'product_id'=> $request->invoice[$i]["produk"],
                'jumlah'=> $request->invoice[$i]["jumlah"],
                'satuan'=> $request->invoice[$i]["satuan"],
                'harga_satuan'=> $request->invoice[$i]["harga_satuan"],
                'total'=> $request->invoice[$i]["total"],
            ]);
            $jml = $jml + $request->invoice[$i]["jumlah"];
        }
        DB::table('terima_buys')->where('id',$id->id)->update([
            'total' => $jml
        ]);
        return redirect()->route('admin.terima.index')->with('success', 'Proses Penerimaan Barang');
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
        $pesanan = PesananBuys::all();
        return view('admin.purchase.penerimaan.'.$id,compact('produk','pemasok','pesanan'));
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
