<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KontakRequest;
use App\Models\{Kategori, Kontak};
use Illuminate\Support\Facades\DB;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kontak = Kontak::get();
        // ->where('aktif', 1);

        return view('admin.kontak.index', [
            'countkontak' => Kontak::count(),
            'kontak' => $kontak
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kontak.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KontakRequest $request)
    {
        $attr = $request->all();
        if (!request('pelanggan')) {
            $attr['pelanggan'] = 0;
        } else {
            $attr['pelanggan'] = 1;
        }
        if (!request('pemasok')) {
            $attr['pemasok'] = 0;
        } else {
            $attr['pemasok'] = 1;
        }
        if (!request('karyawan')) {
            $attr['karyawan'] = 0;
        } else {
            $attr['karyawan'] = 1;
        }
        if (!request('nasabah')) {
            $attr['nasabah'] = 0;
        } else {
            $attr['nasabah'] = 1;
        }
        if (!request('petugas')) {
            $attr['petugas'] = 0;
        } else {
            $attr['petugas'] = 1;
        }
        if (!request('aktif')) {
            $attr['aktif'] = 0;
        } else {
            $attr['aktif'] = 1;
        }
        try {
            Kontak::create($attr);
        } catch (\Exception $e) {
            return back()->with('error', 'Data Gagal Disimpan!')->withErrors($e->getMessage());
        }
        return redirect()->route('admin.kontak.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kontak $kontak)
    {
        return view('admin.kontak.show', compact('kontak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontak $kontak)
    {
        return view('admin.kontak.edit', compact('kontak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Kontak $kontak, KontakRequest $request)
    {
        $attr = $request->all();
        if (!request('pelanggan')) {
            $attr['pelanggan'] = 0;
        } else {
            $attr['pelanggan'] = 1;
        }
        if (!request('pemasok')) {
            $attr['pemasok'] = 0;
        } else {
            $attr['pemasok'] = 1;
        }
        if (!request('karyawan')) {
            $attr['karyawan'] = 0;
        } else {
            $attr['karyawan'] = 1;
        }
        if (!request('nasabah')) {
            $attr['nasabah'] = 0;
        } else {
            $attr['nasabah'] = 1;
        }
        if (!request('petugas')) {
            $attr['petugas'] = 0;
        } else {
            $attr['petugas'] = 1;
        }
        if (!request('aktif')) {
            $attr['aktif'] = 0;
        } else {
            $attr['aktif'] = 1;
        }
        try {
            $kontak->update($attr);
        } catch (\Exception $e) {
            return back()->with('error', 'Data Gagal diupdate!')->withErrors($e->getMessage());
        }
        return redirect()->route('admin.kontak.index')->with('success', 'Data Berhasil DIupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontak $kontak)
    {
        if ($kontak->jurnalumums()) {
            $kontak->jurnalumums()->delete();
        }
        $kontak->delete();
        return redirect()->route('admin.kontak.index')
            ->with('success', 'Data Berhasil Dihapus');
    }

    public function kontakKode()
    {
        $nama = ltrim(request()->nama)[0];
        $kontak = Kontak::select('id', 'nama')
            ->where(DB::raw('LEFT(nama, 1)'), $nama)
            ->count();

        $huruf = ucfirst($nama) . "-";

        if ($kontak > 0) {
            $jumlah = $kontak + 1;
            $result = $huruf . sprintf("%05s", $jumlah);
        } else {
            $result = $huruf . "00001";
        }

        return response()->json(['success' => $result]);
    }
}
