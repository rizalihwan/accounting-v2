<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Kontak;
use Illuminate\Http\Request;

class JurnalUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.jurnalumum.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jurnalumum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->except('_token'));
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

    // API
    public function getKontak(Request $request)
    {
        $search = $request->search;
        $contacts = Kontak::select('id', 'nama', 'email', 'nik', 'telepon')
            ->where('nama', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('nik', 'like', "%{$search}%")
            ->orWhere('telepon', 'like', "%{$search}%")
            ->orderBy('nama', 'ASC')->get()->take(20);

        $result = [];

        foreach ($contacts as $kontak) {
            $nik = empty($kontak->nik) ? ' - ' : $kontak->nik;
            $result[] = [
                "id" => $kontak->id,
                "text" => "{$kontak->nama} ({$nik})",
                "nama" => $kontak->nama,
                "email" => $kontak->email,
                "telepon" => $kontak->telepon
            ];
        }

        return $result;
    }

    public function getAkun(Request $request)
    {
        $search = $request->search;
        $accounts = Akun::select('id', 'kode', 'name', 'status')
            ->where('status', '1')
            ->where('kode', 'like', "%{$search}%")
            ->orWhere('name', 'like', "%{$search}%")
            ->orderBy('name', 'ASC')->get();

        $result = [];

        foreach ($accounts as $a) {
            $result[] = [
                'id' => $a->id,
                'text' => "{$a->name} ({$a->kode})",
                'kode' => $a->kode,
                'name' => $a->name
            ];
        }

        return $result;
    }
}
