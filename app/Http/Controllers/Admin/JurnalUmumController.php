<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Divisi;
use App\Models\Jurnalumum;
use App\Models\Jurnalumumdetail;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $data = Jurnalumum::with('jurnalumumdetails')->latest();
        return view('admin.jurnalumum.index', [
            'data' => $data->paginate(10),
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
            'kode' => $this->kode,
            'divisis' => Divisi::orderBy('nama', 'ASC')->get()
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
        $jurnal = new Jurnalumum;
        $jurnal->kode_jurnal = $request->kode_jurnal;
        $jurnal->tanggal = $request->tanggal;
        $jurnal->kontak_id = $request->kontak_id;
        $jurnal->divisi_id = $request->divisi_id;
        $jurnal->uraian = $request->uraian;
        $jurnal->status = 1;
        $jurnal->save();
        $arrReq = count($request->jurnals);
        for ($i = 0; $i < $arrReq; $i++) {
            try {
                Jurnalumumdetail::create([
                    'akun_id' => $request->jurnals[$i]['akun_id'],
                    'jurnalumum_id' => $jurnal->id,
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
        $data = Jurnalumum::findOrFail($id);
        return view('admin.jurnalumum.show', compact('data'));
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

        $jurnal = Jurnalumum::find($id);

        return view('admin.jurnalumum.edit', [
            'jurnal' => $jurnal,
            'totalJurnals' => $jurnal->jurnalumumdetails->count()
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
        $input = $request->except('_token', '_method');

        $error = Validator::make($input, [
            'tanggal' => 'required|date|date_format:Y-m-d',
            'kontak_id'  => 'required|exists:kontaks,id',
            'divisi_id' => 'required|exists:divisis,id',
            'uraian' => 'required|string',
            'jurnals.*.akun_id' => 'required|exists:akuns,id',
            'jurnals.*.debit' => 'required_without:jurnals.*.kredit',
            'jurnals.*.kredit' => 'required_without:jurnals.*.debit',
        ]);

        if ($error->fails()) {
            return response()->json(['error'  => $error->errors()->all()]);
        }

        $detail_id = [];

        foreach ($input['jurnals'] as $value) {
            $detail_id[] = $value['id'];
        }

        $detail_jurnals_except = Jurnalumumdetail::select('id')->whereNotIn('id', $detail_id)->get();
        if ($detail_jurnals_except > 0) {
            foreach ($detail_jurnals_except as $detail) {
                try {
                    $detail->delete();
                } catch (\Exception $e) {
                    return back()->with('error', 'Ada yang salah. Mohon periksa kembali form yang Anda isi');
                }
            }
        }

        $detail_jurnals = Jurnalumumdetail::$jurnal = Jurnalumum::find($id);

        DB::beginTransaction();
        try {
            Jurnalumumdetail::where('jurnalumum_id', $jurnal->id)->each(function ($detail_jurnal) use ($input) {
                foreach ($input['jurnals'] as $value) {
                    $detail_jurnal->update([
                        'akun_id' => $value['akun_id'],
                        'debit' => $value['debit'],
                        'kredit' => $value['kredit'],
                    ]);
                }
            });

            $jurnal->update([
                'status' => $input['status'],
                'tanggal' => $input['tanggal'],
                'kontak_id' => $input['kontak_id'],
                'divisi_id' => $input['divisi_id'],
                'uraian' => $input['uraian']
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Ada yang salah. Mohon periksa kembali form yang Anda isi!');
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
        $jurnals = Jurnalumumdetail::where('jurnalumum_id', $id);
        try {
            $jurnals->delete();
            Jurnalumum::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Jurnal tidak Terhapus!' . $e->getMessage());
        }
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
            $result[] = [
                "id" => $kontak->id,
                "text" => $kontak->nama,
                "nama" => $kontak->nama,
                "email" => $kontak->email,
                "telepon" => $kontak->telepon
            ];
        }

        return $result;
    }

    public function kontakSelected($id)
    {
        $kontak = Kontak::find($id);

        $result = [
            'id' => $kontak->id,
            'text' => $kontak->nama,
            'nama' => $kontak->nama,
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

    public function getDivisi(Request $request)
    {
        $search = $request->search;
        $divitions = Divisi::select('id', 'kode', 'nama')
            ->where('kode', 'like', "%{$search}%")
            ->orWhere('nama', 'like', "%{$search}%")
            ->orderBy('nama', 'ASC')->get()->take(20);

        $results = [];
        foreach ($divitions as $d) {
            $results[] = [
                'id' => $d->id,
                'text' => "{$d->nama} ({$d->kode})",
                'kode' => $d->kode,
                'nama' => $d->nama
            ];
        }

        return $results;
    }

    public function divisiSelected(Divisi $divisi)
    {
        $result = [
            'id' => $divisi->id,
            'text' => "{$divisi->nama} ({$divisi->kode})",
            'kode' => $divisi->kode,
            'nama' => $divisi->nama
        ];

        return $result;
    }
}
