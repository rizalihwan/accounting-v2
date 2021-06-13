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
        if ($number > 0) {
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
        $selectKode = Jurnalumum::distinct()->pluck('kode_jurnal');
        $data = Jurnalumum::whereIn('kode_jurnal', $selectKode)->groupBy('kode_jurnal');
        return view('admin.jurnalumum.index', [
            'data' => $data->get(),
            'countJurnal' => $data->count()
        ]);
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
        // dd($request->except('_token'));
        $arrReq = count($request->jurnals);
        for ($i = 0; $i < $arrReq; $i++) {
            try {
                Jurnalumum::create([
                    'kode_jurnal' => $request->kode_jurnal,
                    'tanggal' => $request->tanggal,
                    'kontak_id' => $request->kontak_id,
                    'uraian' => $request->uraian,
                    'status' => 1,
                    'akun_id' => $request->jurnals[$i]['akun_id'],
                    'debit' => $request->jurnals[$i]['debit'],
                    'kredit' => $request->jurnals[$i]['kredit']
                ]);
            } catch (\Exception $e) {
                return back()->with('error', 'Jurnal tidak Tersimpan!' . $e->getMessage());
            }
        }
        return redirect()->route('admin.jurnalumum.index')->with('success', 'Jurnal Umum berhasil Tersimpan');
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
        if (empty(Jurnalumum::find($id))) {
            return redirect()->route('admin.jurnalumum.index')->with('error', 'Data tidak ditemukan');
        }

        $kode = Jurnalumum::where('id', $id)->distinct()->pluck('kode_jurnal')->first();
        $jurnal = Jurnalumum::where('kode_jurnal', $kode)
            ->select('id', 'tanggal', 'kode_jurnal', 'kontak_id', 'uraian')
            ->groupBy('kode_jurnal')->first();
        $jurnals = Jurnalumum::where('kode_jurnal', $kode)
            ->select('id', 'akun_id', 'debit', 'kredit', 'status');

        return view('admin.jurnalumum.edit', [
            'kode' => $kode,
            'jurnal' => $jurnal,
            'jurnals' => $jurnals->get(),
            'totalJurnals' => $jurnal->count()
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
        $jurnals = Jurnalumum::where('kode_jurnal', $id);
        $arrReq = count($request->jurnals);

        // for ($i = 0; $i < $arrReq; $i++) {
        //     echo $request->jurnals[$i]['kredit'];
        // }
        // dd();

        if ($arrReq > $jurnals->count()) {
            for ($i = 0; $i < $arrReq; $i++) {
                try {
                    Jurnalumum::create([
                        'kode_jurnal' => $request->kode_jurnal,
                        'tanggal' => $request->tanggal,
                        'kontak_id' => $request->kontak_id,
                        'uraian' => $request->uraian,
                        'status' => 1,
                        'akun_id' => $request->jurnals[$i]['akun_id'],
                        'debit' => $request->jurnals[$i]['debit'],
                        'kredit' => $request->jurnals[$i]['kredit']
                    ]);
                } catch (\Exception $e) {
                    return back()->with('error', 'Jurnal tidak Tersimpan!' . $e->getMessage());
                }
            }
        } else {
            try {
                /**
                 * UPDATE INI MASIH ERROR ZAL.
                 * pang benerken wkwkwk.
                 */
                for ($i = 0; $i < $arrReq; $i++) {
                    foreach ($jurnals->get() as $index => $item) {
                        $item->update([
                            'tanggal' => $request->tanggal,
                            'kontak_id' => $request->kontak_id,
                            'uraian' => $request->uraian,
                            'status' => 1,
                            'akun_id' => $request->jurnals[$i]['akun_id'],
                            'debit' => $request->jurnals[$i]['debit'],
                            'kredit' => $request->jurnals[$i]['kredit']
                        ]);
                    }
                }
            } catch (\Exception $e) {
                return back()->with('error', 'Jurnal gagal diubah!');
            }
        }

        return redirect()->route('admin.jurnalumum.index')->with('success', 'Jurnal Umum berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jurnalumum::findOrFail($id)->delete();
        return back()->with('success', 'Jurnal Umum berhasil Dihapus');
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

    public function kontakSelected($id)
    {
        $jurnal = Jurnalumum::with('kontak')->find($id);
        $kontak = $jurnal->kontak;

        $nik = empty($kontak->nik) ? ' - ' : $kontak->nik;
        $result = [
            'id' => $kontak->id,
            'text' => "{$kontak->nama} ({$nik})",
            'nama' => $kontak->nama,
            'email' => $kontak->email,
            'telepon' => $kontak->telepon
        ];

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
                'text' => "{$a->name}",
                'kode' => $a->kode,
                'name' => $a->name
            ];
        }

        return $result;
    }

    public function akunSelected(Akun $akun)
    {
        $result = [
            'id' => $akun->id,
            'text' => "{$akun->name}",
            'kode' => $akun->kode,
            'name' => $akun->name
        ];

        return $result;
    }
}
