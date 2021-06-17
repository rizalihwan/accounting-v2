<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bkk;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indeks = BKK::where('status','BKM')->get();
        $row = DB::table('bkks')->orderBy('id', 'DESC')->get()->count();
        return view('admin.bkm.index',compact('indeks','row'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow = Bkk::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();
        $kode = "";
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "KK0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "KK000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "KK00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "KK0".''.($lastId->id + 1);
            } else {
                   $kode = "KK".''.($lastId->id + 1);
            }
        }
        $rekening = Akun::with(['subklasifikasi' => function ($query) {
            $query->where('name', 'like', '%kas%')
                  ->orWhere('name', 'like', '%bank%');
        }])->get();
        $kontak = DB::table('kontaks')->get();
        return view('admin.bkm.create',compact('rekening','kontak','kode'));
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
            'status' => 'BKM',
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
        return redirect()->route('admin.bkm.index')->with('success', 'Buku Kas berhasil Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bkk  $bkm
     * @return \Illuminate\Http\Response
     */
    public function show(Bkk $bkm)
    {
        $show = Bkk::find($bkm)->first();
        return view('admin.bkm.show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bkk  $bkm
     * @return \Illuminate\Http\Response
     */
    public function edit(Bkk $bkm)
    {
        $rekening = Akun::with(['subklasifikasi' => function ($query) {
            $query->where('name', 'like', '%kas%')
                  ->orWhere('name', 'like', '%bank%');
        }])->get();
        $kontak = DB::table('kontaks')->get();
        $datas = Bkk::find($bkm)->first();
        return view('admin.bkm.edit',compact('datas','kontak','rekening'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bkk  $bkm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bkk $bkm)
    {
        $bkm->delete();
        $imam = count($request->invoice);

        $jml=0;
        DB::table('bkks')->insert([
            'id' => $bkm->id,
            'tanggal' => $request->tanggal,
            'kontak_id' =>$request->kontak,
            'desk' => $request->desk,
            'rekening_id' =>$request->rek,
            'status' => 'BKM',
        ]);
        for ($i=0; $i < $imam; $i++) { 
            DB::table('uraians')->insert([
                'rekening_id'=> $request->invoice[$i]["rekening"],
                'bkk_id'=> $bkm->id,
                'jml_uang'=> $request->invoice[$i]["jumlah"],
                'catatan'=> $request->invoice[$i]["catatan"],
                'uang'=> $request->invoice[$i]["matauang"],
            ]);
            $jml = $jml + $request->invoice[$i]["jumlah"];
        }
        DB::table('bkks')->where('id',$bkm->id)->update([
            'value' => $jml
        ]);
        return redirect()->route('admin.bkm.index')->with('success', 'Buku Kas berhasil Terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bkk  $bkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bkk $bkm)
    {
        $bkm->delete();

        return back()->with('success','Data Berhasil Dihapus');
    }
}
