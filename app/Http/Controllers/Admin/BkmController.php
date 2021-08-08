<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Bkk, BkkDetail};
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indeks = BKK::where('status', 'BKM')->paginate(5);
        $row = DB::table('bkks')->orderBy('id', 'DESC')->get()->count();
        return view('admin.bkm.index', compact('indeks', 'row'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow = Bkk::where('status', 'BKM')->orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();
        $kode = "";
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "KM0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "KM000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "KM00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "KM0" . '' . ($lastId->id + 1);
            } else {
                $kode = "KM" . '' . ($lastId->id + 1);
            }
        }

        return view('admin.bkm.create', compact('kode'));
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
            'bkm.*.rekening' => 'required|exists:akuns,id',
            'bkm.*.jumlah' => 'required',
            'bkm.*.catatan' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        try {
            DB::transaction(function () use ($request) {
                $bkm = Bkk::create(array_merge($request->except('bkm'), [
                    'status' => 'BKM'
                ]));

                $totalUang = 0;
                foreach ($request->bkm as $detail) {
                    $jumlah_uang = (int)preg_replace('/[^\d.]/', '', $detail['jumlah']);
                    BkkDetail::create([
                        'bkk_id' => $bkm->id,
                        'rekening_id' => $detail['rekening'],
                        'jml_uang' => $jumlah_uang,
                        'catatan' => $detail['catatan'],
                    ]);

                    $totalUang += $jumlah_uang;
                }

                $bkm->update(['value' => $totalUang]);
            });

            return redirect()->route('admin.bkm.index')->with('success', 'Buku Kas berhasil Tersimpan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bkk  $bkm
     * @return \Illuminate\Http\Response
     */
    public function show(Bkk $bkm)
    {
        return view('admin.bkm.show', [
            'show' => $bkm
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bkk  $bkm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bkm = Bkk::where('status', 'BKM')->findOrFail($id);
        return view('admin.bkm.edit', compact('bkm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bkk  $bkm
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
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $bkm = Bkk::where('status', 'BKM')->findOrFail($id);

        try {
            DB::transaction(function () use ($request, $id, $bkm) {
                $detail_id = [];

                foreach ($request->bkm as $value) {
                    $detail_id[] = $value['id'];
                }

                $detail_id = array_filter($detail_id, fn ($value) => !is_null($value) && $value !== '');
                BkkDetail::where('bkk_id', $id)
                    ->whereNotIn('id', $detail_id)
                    ->delete();

                $value = 0;
                foreach ($request->bkm as $item) {
                    $jml_uang = (int)preg_replace('/[^\d.]/', '', $item['jumlah']);

                    if ($item['id'] != null) {
                        BkkDetail::where('id', $item['id'])->update([
                            'rekening_id' => $item['rekening'],
                            'jml_uang' => $jml_uang,
                            'catatan' => $item['catatan'],
                        ]);
                    } else {
                        BkkDetail::create([
                            'bkk_id' => $id,
                            'rekening_id' => $item['rekening'],
                            'jml_uang' => $jml_uang,
                            'catatan' => $item['catatan'],
                        ]);
                    }

                    $value += $jml_uang;
                }

                $bkm->update(array_merge($request->except('bkm'), [
                    'value' => $value
                ]));
            });

            return redirect()->route('admin.bkm.index')->with('success', 'Buku Kas berhasil Terupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bkk  $bkm
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bkm = Bkk::where('status', 'BKM')->findOrFail($id);
        $bkm->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
