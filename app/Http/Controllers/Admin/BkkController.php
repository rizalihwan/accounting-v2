<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Bkk, BkkDetail,Akun};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            return redirect()->back()->withInput()->withErrors($validation);
        }

        try {
            DB::transaction(function () use ($request) {
                $bkk = Bkk::create(array_merge($request->except('bkk'), [
                    'status' => 'BKK'
                ]));

                $totalUang = 0;

                foreach ($request->bkk as $detail) {
                    $jumlah_uang = (int)preg_replace('/[^\d.]/', '', $detail['jumlah']);
                    DB::table('akuns')->where('id',$detail['rekening'])->update([
                        'debit'=> DB::raw('debit + '.$jumlah_uang) 
                    ]);
                    BkkDetail::create([
                        'bkk_id' => $bkk->id,
                        'rekening_id' => $detail['rekening'],
                        'jml_uang' => $jumlah_uang,
                        'catatan' => $detail['catatan'],
                    ]);
                    $totalUang += $jumlah_uang;
                }
                DB::table('akuns')->where('id',$request['rekening_id'])->update([
                    'kredit'=> DB::raw('kredit + '.$totalUang) 
                ]);
                $bkk->update(['value' => $totalUang]);
            });

            return redirect()->route('admin.bkk.index')->with('success', 'Buku Kas berhasil Tersimpan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
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
    public function edit($id)
    {
        $bkk = Bkk::findOrFail($id);
        return view('admin.bkk.edit', compact('bkk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bkk  $bkk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        $bkk = Bkk::findOrFail($id);
        //buat hapus yang lama biar di update yang baru
        DB::table('akuns')->where('id',$bkk->rekening_id)->update([
            'kredit'=> DB::raw('kredit - '.$bkk->value) 
        ]);
        $bkkdetail = BkkDetail::where('bkk_id',$bkk->id)->get();
        foreach ($bkkdetail as $key) {
            DB::table('akuns')->where('id',$key->rekening_id)->update([
                'debit'=> DB::raw('debit - '.$key->jml_uang) 
            ]);
        }

        try {
            DB::transaction(function () use ($request, $id, $bkk) {
                $detail_id = [];

                foreach ($request->bkk as $value) {
                    $detail_id[] = $value['id'];
                }

                $detail_id = array_filter($detail_id, fn ($value) => !is_null($value) && $value !== '');
                BkkDetail::where('bkk_id', $id)
                    ->whereNotIn('id', $detail_id)
                    ->delete();

                $value = 0;
                foreach ($request->bkk as $item) {
                    $jml_uang = (int)preg_replace('/[^\d.]/', '', $item['jumlah']);

                    if ($item['id'] != null) {
                        //update akunsnya
                        DB::table('akuns')->where('id',$item['rekening'])->update([
                            'debit'=> DB::raw('debit + '.$jml_uang) 
                        ]);
                        BkkDetail::where('id', $item['id'])->update([
                            'rekening_id' => $item['rekening'],
                            'jml_uang' => $jml_uang,
                            'catatan' => $item['catatan'],
                        ]);
                    } else {
                        //update akunsnya
                        DB::table('akuns')->where('id',$item['rekening'])->update([
                            'debit'=> DB::raw('debit + '.$jml_uang) 
                        ]);
                        BkkDetail::create([
                            'bkk_id' => $id,
                            'rekening_id' => $item['rekening'],
                            'jml_uang' => $jml_uang,
                            'catatan' => $item['catatan'],
                        ]);
                    }


                    $value += $jml_uang;
                }
                //ini buat update akunsnya
                DB::table('akuns')->where('id',$request['rekening_id'])->update([
                    'kredit'=> DB::raw('kredit + '.$value) 
                ]);
                $bkk->update(array_merge($request->except('bkk'), [
                    'value' => $value
                ]));
            });

            return redirect()->route('admin.bkk.index')->with('success', 'Buku Kas berhasil Terupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bkk  $bkk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bkk = Bkk::findOrFail($id);
        DB::table('akuns')->where('id',$bkk->rekening_id)->update([
            'kredit'=> DB::raw('kredit - '.$bkk->value) 
        ]);
        $bkkdetail = BkkDetail::where('bkk_id',$bkk->id)->get();
        foreach ($bkkdetail as $key) {
            DB::table('akuns')->where('id',$key->rekening_id)->update([
                'debit'=> DB::raw('debit - '.$key->jml_uang) 
            ]);
        }
        $bkk->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
