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
        $input = $request->except('_token');

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
            return redirect()->back()->withErrors($error);
        }

        try {
            $jurnal = Jurnalumum::create([
                'kode_jurnal' => $input['kode_jurnal'],
                'tanggal' => $input['tanggal'],
                'kontak_id' => $input['kontak_id'],
                'divisi_id' => $input['divisi_id'],
                'uraian' => $input['uraian'],
                'status' => 1
            ]);

            foreach ($input['jurnals'] as $input_jurnal) {
                Jurnalumumdetail::create([
                    'akun_id' => $input_jurnal['akun_id'],
                    'jurnalumum_id' => $jurnal->id,
                    'debit' => $input_jurnal['debit'] == null ? '0' : $input_jurnal['debit'],
                    'kredit' => $input_jurnal['kredit'] == null ? '0' : $input_jurnal['kredit']
                ]);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Jurnal tidak Tersimpan!' . $e->getMessage());
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
            return redirect()->back()->withErrors($error);
        }

        $jurnal = Jurnalumum::find($id);
        $jurnal->update([
            'tanggal' => $request->tanggal,
            'kontak_id' => $request->kontak_id,
            'divisi_id' => $request->divisi_id,
            'uraian' => $request->uraian,
        ]);

        $detail_id = [];

        foreach ($input['jurnals'] as $value) {
            $detail_id[] = $value['id'];
        }

        $jurnals = array_values(array_filter($detail_id, fn ($value) => is_null($value) && $value == ''));
        $detail_id = array_filter($detail_id, fn ($value) => !is_null($value) && $value !== '');

        $detail_jurnals_except = Jurnalumumdetail::select('id')->where('jurnalumum_id', $id)
            ->whereNotIn('id', $detail_id)->get();

        DB::beginTransaction();
        try {
            if ($detail_jurnals_except->count() > 0) {
                foreach ($detail_jurnals_except as $detail) {
                    $detail->delete();
                }
            }

            foreach ($jurnals as $value) {
                foreach ($input['jurnals'] as $item) {
                    if ($value == $item['id']) {
                        Jurnalumumdetail::create([
                            'akun_id' => $item['akun_id'],
                            'jurnalumum_id' => $jurnal->id,
                            'debit' => $item['debit'],
                            'kredit' => $item['kredit']
                        ]);
                    }
                }
            }

            foreach ($input['jurnals'] as $index => $item) {
                if ($item['id'] != null) {
                    Jurnalumumdetail::where('id', $item['id'])->update([
                        'akun_id' => $item['akun_id'],
                        'debit' => $item['debit'],
                        'kredit' => $item['kredit'],
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Oops, something went wrong');
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

    public function kontakSelected(Kontak $kontak)
    {
        $result = [
            "id" => $kontak->id,
            "text" => $kontak->nama,
            "nama" => $kontak->nama,
            "email" => $kontak->email,
            "telepon" => $kontak->telepon
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
