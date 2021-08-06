<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Bkk, BkkDetail, Akun, Kontak};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $bkks = Bkk::where('status', 'BKK');
        $indeks = $bkks->paginate(5);
        $countBkk = $bkks->count();
        $row = Bkk::orderBy('id', 'DESC')->get()->count();
        return view('admin.bkk.index', compact('indeks', 'row', 'countBkk'));
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
        $kode = "KK00001";
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "KK0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "KK000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "KK00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "KK0" . '' . ($lastId->id + 1);
            } else {
                $kode = "KK" . '' . ($lastId->id + 1);
            }
        }

        return view('admin.bkk.create', compact('kode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'tanggal' => 'required',
            'kontak_id' => 'required|exists:kontaks,id',
            'desk' => 'required',
            'rekening_id' => 'required|exists:akuns,id',
            'bkk.*.rekening' => 'required|exists:akuns,id',
            'bkk.*.jumlah' => 'required',
            'bkk.*.catatan' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        try {
            DB::transaction(function () use ($request) {
                $bkk = Bkk::create(array_merge($request->except('bkk'), [
                    'status' => 'BKK'
                ]));

                $totalUang = 0;

                foreach ($request->bkk as $detail) {
                    $jumlah_uang = (int)preg_replace('/[^\d.]/', '', $detail['jumlah']);
                    BkkDetail::create([
                        'bkk_id' => $bkk->id,
                        'rekening_id' => $detail['rekening'],
                        'jml_uang' => $jumlah_uang,
                        'catatan' => $detail['catatan'],
                    ]);

                    $totalUang += $jumlah_uang;
                }

                $bkk->update(['value' => $totalUang]);
            });

            return redirect()->route('admin.bkk.index')->with('success', 'Buku Kas berhasil Tersimpan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bkk  $bkk
     * @return \Illuminate\Http\Response
     */
    public function show(Bkk $bkk)
    {
        return view('admin.bkk.show', [
            'show' => $bkk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bkk  $bkk
     * @return \Illuminate\Http\Response
     */
    public function edit(Bkk $bkk)
    {
        $rekening = Akun::with(['subklasifikasi' => function ($query) {
            $query->where('name', 'like', '%kas%')
                ->orWhere('name', 'like', '%bank%');
        }])->get();
        $rekenings = Akun::all();
        $kontak = DB::table('kontaks')->get();
        return view('admin.bkk.edit', [
            'datas' => $bkk,
            'kontak' => $kontak,
            'rekening' => $rekening,
            'rekenings' => $rekenings
        ]);
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
        $bkk->delete();
        $imam = count($request->invoice);

        $jml = 0;
        DB::table('bkks')->insert([
            'id' => $bkk->id,
            'tanggal' => $request->tanggal,
            'kontak_id' => $request->kontak,
            'desk' => $request->desk,
            'rekening_id' => $request->rek,
            'status' => 'BKK',
        ]);
        for ($i = 0; $i < $imam; $i++) {
            DB::table('uraians')->insert([
                'rekening_id' => $request->invoice[$i]["rekening"],
                'bkk_id' => $bkk->id,
                'jml_uang' => $request->invoice[$i]["jumlah"],
                'catatan' => $request->invoice[$i]["catatan"],
                'uang' => $request->invoice[$i]["matauang"],
            ]);
            $jml = $jml + $request->invoice[$i]["jumlah"];
        }
        DB::table('bkks')->where('id', $bkk->id)->update([
            'value' => $jml
        ]);
        return redirect()->route('admin.bkk.index')->with('success', 'Buku Kas berhasil Terupdate');
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

        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
