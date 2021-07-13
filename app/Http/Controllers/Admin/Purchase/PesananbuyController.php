<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Models\Product;
use App\Models\Purchase\PesananBuys;
use App\Models\Purchase\PenawaranBuys;
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
        $pesanans = PesananBuys::select('id', 'tanggal', 'kode', 'total', 'status', 'pelanggan_id')->with('pemasok:id,nama');

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
        $imam = count($request->invoice);
        
        $jml=0;
        DB::table('pesanan_buys')->insert([
            'tanggal' => $request->tanggal,
            'pemasok_id' =>$request->pemasok,
            'no_penawaaran' =>$request->no_penawaran,
            'desc' => $request->Deskripsi,
            'status' => '1',
        ]);
        $id = DB::table('pesanan_buys')->select('id')
                              ->orderByDesc('id')
                              ->first();
        for ($i=0; $i < $imam; $i++) { 
            DB::table('pesanan_buy_detail')->insert([
                'pesanan_id'=> $id->id,
                'product_id'=> $request->invoice[$i]["produk"],
                'jumlah'=> $request->invoice[$i]["jumlah"],
                'satuan'=> $request->invoice[$i]["satuan"],
                'harga_satuan'=> $request->invoice[$i]["harga_satuan"],
                'total'=> $request->invoice[$i]["total"],
            ]);
            $jml = $jml + $request->invoice[$i]["jumlah"];
        }
        DB::table('pesanan_buys')->where('id',$id->id)->update([
            'total' => $jml
        ]);
        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan sedang di proses ');
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
        $penawaran = PenawaranBuys::all();
        return view('admin.purchase.pemesanan.'.$id,compact('produk','pemasok','penawaran'));
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
