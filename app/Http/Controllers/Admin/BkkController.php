<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bkk;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class BkkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indeks = Bkk::where('status','BKK')->get();
        $row = DB::table('bkks')->orderBy('id', 'DESC')->get()->count();
        return view('admin.bkk.index',compact('indeks','row'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rekening = Akun::get();
        $kontak = DB::table('kontaks')->get();
        return view('admin.bkk.create',compact('rekening','kontak'));
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
        
        // foreach($id->rekenings as $s){
        //    echo $s->jml_uang ;
        // }
        // dd($request->all());
        $jml=0;
        DB::table('bkks')->insert([
            'tanggal' => $request->tanggal,
            'kontak_id' =>$request->kontak,
            'desk' => $request->desk,
            'rekening_id' =>$request->rek,
            'status' => 'BKK',
        ]);
        $id = DB::table('bkks')->select('id')
                              ->orderByDesc('id')
                              ->first();
        for ($i=0; $i < $imam; $i++) { 
            DB::table('uraians')->insert([
                'rekening_id'=> $request->invoice[$i]["rekening"],
                'bkk_id'=> $id->id,
                'jml_uang'=> $request->invoice[$i]["jumlah"],
                'catatan'=> $request->invoice[$i]["catatan"],
                'uang'=> $request->invoice[$i]["matauang"],
            ]);
            $jml = $jml + $request->invoice[$i]["jumlah"];
        }
        DB::table('bkks')->where('id',$id->id)->update([
            'value' => $jml
        ]);
        return back()->with('success','Kas berhasil Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bkk  $bkk
     * @return \Illuminate\Http\Response
     */
    public function show(Bkk $bkk)
    {
        $show = Bkk::find($bkk)->first();
        return view('admin.bkk.show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bkk  $bkk
     * @return \Illuminate\Http\Response
     */
    public function edit(Bkk $bkk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bkk  $bkk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bkk $bkk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bkk  $bkk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bkk $bkk)
    {
        $bkk->delete();

        return back()->with('success','Data Berhasil Dihapus');
    }
}
