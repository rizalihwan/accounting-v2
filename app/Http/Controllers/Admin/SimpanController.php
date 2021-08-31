<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SimpanExport;
use App\Http\Controllers\Controller;
use App\Imports\SimpanImport;
use App\Models\Kontak;
use App\Models\Simpan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SimpanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.simpan.index', [
            'data' => Simpan::latest()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.simpan.create', [
            'contacts' => Kontak::get(),
            'petugas' => Kontak::where('nasabah', 1)->pluck('nama')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $reqArr = [
            'keterangan' => 'required',
            'kontak_id' => 'required',
            'jenis_simpanan' => 'required',
            'no_rekening' => 'required',
            'administrasi' => 'required',
            'setoran' => 'required',
            'petugas' => 'required'
        ];
        $attr = $this->validate(request(), $reqArr);
        $allReq = Validator::make(request()->all(), $reqArr);
        if ($allReq->fails()) {
            return redirect()->back()->withErrors($allReq);
        }
        try {
            Simpan::create($attr);
        } catch (\Exception $e) {
            return back()->with('error', 'Simpanan gagal!' . $e->getMessage());
        }
        return redirect()->route('admin.simpan.index')->with('success', 'Simpanan berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Simpan  $simpan
     * @return \Illuminate\Http\Response
     */
    public function show(Simpan $simpan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Simpan  $simpan
     * @return \Illuminate\Http\Response
     */
    public function edit(Simpan $simpan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Simpan  $simpan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Simpan $simpan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Simpan  $simpan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Simpan $simpan)
    {
        //
    }
    public function export()
    {
        ob_end_clean();
        ob_start();
        return Excel::download(new SimpanExport(), 'Simpan Export.xlsx');
    }
    public function import_form()
    {
        return view('admin.simpan.import',[
            'kontak' => Kontak::get()
        ]);
    }
    public function import(Request $request)
    {
        $this->validate($request, [
            'import' => 'required|mimes:csv,xlsx,xls'
        ]);
        try {
            $file = $request->file('import');
            $name_file = rand() . '_' . $file->getClientOriginalName();
            $file->move('import/simpan/', $name_file);
            Excel::import(new SimpanImport, public_path('import/simpan/' . $name_file));
            return redirect('/admin/simpanpinjam/simpan');
        } catch (Exception $err) {
            dd($err->getMessage());
        }
    }
}
