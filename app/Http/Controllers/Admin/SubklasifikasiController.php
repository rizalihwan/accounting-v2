<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subklasifikasi;
use Illuminate\Http\Request;

class SubklasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subklasifikasi.index', [
            'data' => Subklasifikasi::orderBy('name', 'ASC')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subklasifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attr = $this->validate(request(), [
            'name' => 'required'
        ]);
        try {
            Subklasifikasi::create($attr);
        } catch (\Exception $e) {
            return back()->with('error', 'Data Gagal Disimpan!' . $e->getMessage());
        }
        return back()->with('success', 'Data Berhasil Disimpan');
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
    public function edit(Subklasifikasi $subklasifikasi)
    {
        return view('admin.subklasifikasi.edit', compact('subklasifikasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Subklasifikasi $subklasifikasi)
    {
        $attr = $this->validate(request(), [
            'name' => 'required'
        ]);
        try {
            $subklasifikasi->update($attr);
        } catch (\Exception $e) {
            return back()->with('error', 'Data Gagal Dihapus!' . $e->getMessage());
        }
        return back()->with('success', 'Data Berhasil Dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Subklasifikasi::findOrFail($id)->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Data Gagal Dihapus!' . $e->getMessage());
        }
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
