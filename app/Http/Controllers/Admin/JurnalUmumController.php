<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Jurnalumum;
use App\Models\Kontak;
use Illuminate\Http\Request;

class JurnalUmumController extends Controller
{
    private $kode;

    public function __construct()
    {
        $number = Jurnalumum::count();
        if($number > 0)
        {
            $number = Jurnalumum::max('kode_jurnal');
            $strnum = substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'JU' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'JU' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'JU' . "00" . $strnum;
            }
        } else {
            $kode = 'JU' . "001";
        }
        $this->kode = $kode;
    }

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
        return view('admin.jurnalumum.create', [
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
