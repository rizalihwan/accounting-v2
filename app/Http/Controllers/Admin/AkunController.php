<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Subklasifikasi;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    private $kode;

    public function __construct()
    {
        $number = Akun::count();
        if ($number > 0) {
            $number = Akun::max('kode');
            $strnum = substr($number, 2, 3);
            //$strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'AC' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'AC' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'AC' . "00" . $strnum;
            }
        } else {
            $kode = 'AC' . "001";
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
        return view('admin.akun.index', [
            'data' => Akun::orderBy('kode', 'ASC')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.akun.create', [
            'subklasifikasi_id' => Subklasifikasi::get(),
            'kode' => $this->kode
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
        $this->validate($request, [
            'kode' => 'required',
            'name' => 'required',
            'subklasifikasi_id' => 'required',
            'level' => 'required',
            'saldo_awal' => 'required',
        ]);

        $data = $request->all();
        $data['saldo_berjalan'] = 0;
        $data['saldo_akhir'] = 0;

        try {
            Akun::create($data);
        } catch (\Exception $e) {
            return back()->with('error', 'Data Gagal Disimpan' . $e->getMessage());
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
    public function edit($id)
    {
        return view('admin.akun.edit', [
            'akun' => Akun::findOrFail($id),
            'subklasifikasi_id' => Subklasifikasi::all()
        ]);
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
        $data = $this->validate($request, [
            'kode' => 'required',
            'name' => 'required',
            'subklasifikasi_id' => 'required'
        ]);
        try {
            Akun::where('id', $id)->update($data);
        } catch (\Exception $e) {
            return back()->with('error', 'Data Gagal Diupdate' . $e->getMessage());
        }
        return back()->with('success', 'Data Berhasil Diupdate');
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
            Akun::findOrFail($id)->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Data Gagal Dihapus' . $e->getMessage());
        }
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
