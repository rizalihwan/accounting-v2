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
            DB::transaction(function () use ($input) {
                $jurnal = Jurnalumum::create([
                    'kode_jurnal' => $input['kode_jurnal'],
                    'tanggal' => $input['tanggal'],
                    'kontak_id' => $input['kontak_id'],
                    'divisi_id' => $input['divisi_id'],
                    'uraian' => $input['uraian'],
                    'status' => 1
                ]);

                foreach ($input['jurnals'] as $input_jurnal) {
                    $debit = $input_jurnal['debit'] == null
                        ? 0
                        : (int)preg_replace('/[^\d.]/', '', $input_jurnal['debit']);
                    $kredit = $input_jurnal['kredit'] == null
                        ? 0
                        : (int)preg_replace('/[^\d.]/', '', $input_jurnal['kredit']);

                    $jurnal_detail = Jurnalumumdetail::create([
                        'akun_id' => $input_jurnal['akun_id'],
                        'jurnalumum_id' => $jurnal->id,
                        'debit' => $debit,
                        'kredit' => $kredit,
                    ]);

                    $akun = Akun::where('id', $jurnal_detail->akun_id)->first();

                    $saldo_akhir = $akun->saldo_awal + ($debit - $kredit);
                    $akun->update([
                        'debit' => $akun->debit + $debit,
                        'kredit' => $akun->kredit + $kredit,
                        'saldo_akhir' => $saldo_akhir
                    ]);
                }
            });

            return redirect()->route('admin.jurnalumum.index')->with('success', 'Jurnal Umum berhasil Tersimpan');
        } catch (\Exception $e) {
            return back()->with('error', 'Jurnal tidak Tersimpan!' . $e->getMessage());
        }
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

        $detail_id = [];

        foreach ($input['jurnals'] as $value) {
            $detail_id[] = $value['id'];
        }

        $jurnals = array_values(array_filter($detail_id, fn ($value) => is_null($value) && $value == ''));
        $detail_id = array_filter($detail_id, fn ($value) => !is_null($value) && $value !== '');

        $detail_jurnals_except = Jurnalumumdetail::select('id', 'akun_id', 'jurnalumum_id', 'debit', 'kredit')
            ->where('jurnalumum_id', $id)
            ->whereNotIn('id', $detail_id)->get();

        try {
            DB::transaction(function () use ($id, $request, $input, $detail_jurnals_except, $jurnals) {
                $jurnal = Jurnalumum::find($id);
                $jurnal->update([
                    'tanggal' => $request->tanggal,
                    'kontak_id' => $request->kontak_id,
                    'divisi_id' => $request->divisi_id,
                    'uraian' => $request->uraian,
                ]);

                if ($detail_jurnals_except->count() > 0) {
                    foreach ($detail_jurnals_except as $detail) {
                        $debit_jurnal = $detail->debit;
                        $kredit_jurnal = $detail->kredit;

                        $akun = Akun::where('id', $detail->akun_id)->first();
                        $debit_akun = $akun->debit;
                        $kredit_akun = $akun->kredit;

                        $debit = $debit_akun - $debit_jurnal;
                        $kredit = $kredit_akun - $kredit_jurnal;

                        $saldo_akhir = $akun->saldo_akhir - ($debit - $kredit);

                        $akun->update([
                            'debit' => $akun->debit - $debit_jurnal,
                            'kredit' => $akun->kredit - $kredit_jurnal,
                            'saldo_akhir' => $saldo_akhir
                        ]);

                        $detail->delete();
                    }
                }

                foreach ($input['jurnals'] as $index => $item) {
                    if ($item['id'] != null) {
                        $jurnal_detail = Jurnalumumdetail::find($item['id']);

                        $debit = $jurnal_detail->debit;
                        $kredit = $jurnal_detail->kredit;

                        $itm_debit = $item['debit'] == null
                            ? 0
                            : (int)preg_replace('/[^\d.]/', '', $item['debit']);
                        $itm_kredit = $item['kredit'] == null
                            ? 0
                            : (int)preg_replace('/[^\d.]/', '', $item['kredit']);

                        $akun = Akun::where('id', $jurnal_detail->akun_id)->first();

                        if ($debit != $itm_debit) {
                            $debit = $akun->debit - $debit;
                            $saldo_akhir = $akun->saldo_awal + ($debit + $itm_debit);
                            $akun->update([
                                'debit' => $debit + $itm_debit,
                                'saldo_akhir' => $saldo_akhir,
                            ]);
                        }
                        if ($kredit != $itm_kredit) {
                            $kredit = $akun->kredit - $kredit;
                            $saldo_akhir = $akun->saldo_awal - ($kredit + $itm_kredit);
                            $akun->update([
                                'kredit' => $kredit + $itm_kredit,
                                'saldo_akhir' => $saldo_akhir
                            ]);
                        }

                        $jurnal_detail->update([
                            'akun_id' => $item['akun_id'],
                            'debit' => $itm_debit,
                            'kredit' => $itm_kredit,
                        ]);
                    } else {
                        $debit = $item['debit'] == null
                            ? 0
                            : (int)preg_replace('/[^\d.]/', '', $item['debit']);
                        $kredit = $item['kredit'] == null
                            ? 0
                            : (int)preg_replace('/[^\d.]/', '', $item['kredit']);

                        $jurnal_detail = Jurnalumumdetail::create([
                            'akun_id' => $item['akun_id'],
                            'jurnalumum_id' => $jurnal->id,
                            'debit' => $debit,
                            'kredit' => $kredit
                        ]);

                        $akun = Akun::where('id', $jurnal_detail->akun_id)->first();
                        $saldo_akhir = $akun->saldo_akhir + ($debit - $kredit);

                        $akun->update([
                            'debit' => $akun->debit + $debit,
                            'kredit' => $akun->kredit + $kredit,
                            'saldo_akhir' => $saldo_akhir,
                        ]);
                    }
                }
            });

            return redirect()->route('admin.jurnalumum.index')->with('success', 'Jurnal Umum berhasil diubah!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Oops, something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurnals = Jurnalumumdetail::where('jurnalumum_id', $id)->get();
        try {
            foreach ($jurnals as $detail) {
                $debit_jurnal = $detail->debit;
                $kredit_jurnal = $detail->kredit;

                $akun = Akun::where('id', $detail->akun_id)->first();
                $debit_akun = $akun->debit;
                $kredit_akun = $akun->kredit;

                $debit = $debit_akun - $debit_jurnal;
                $kredit = $kredit_akun - $kredit_jurnal;

                $saldo_akhir = $akun->saldo_awal - ($debit + $kredit);

                $akun->update([
                    'debit' => $akun->debit - $debit_jurnal,
                    'kredit' => $akun->kredit - $kredit_jurnal,
                    'saldo_akhir' => $saldo_akhir,
                ]);

                $detail->delete();
            }
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
        $page = $request->page;
        $result_count = 10;
        $offset = ($page - 1) * $result_count;

        $kas_bank = $request->kas_bank;
        $accounts = Akun::active()->select('id', 'kode', 'name', 'subklasifikasi', 'status');

        if ($kas_bank == 'yes') {
            $accounts = $accounts->whereIn('subklasifikasi', ['Kas', 'Bank'])
                ->where(function ($q) use ($search) {
                    return $q->where('kode', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
                })->orderBy('kode', 'ASC')->skip($offset)->take($result_count)->get();
        } else {
            $accounts = $accounts->where(function ($q) use ($search) {
                return $q->where('kode', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            })->orderBy('kode', 'ASC')->skip($offset)->take($result_count)->get();
        }

        $endCount = $offset + $result_count;
        $morePages = Akun::active()->count() > $endCount;

        $data = [];
        foreach ($accounts as $a) {
            $data[] = [
                'id' => $a->id,
                'text' => "{$a->name} ({$a->kode})",
                'kode' => $a->kode,
                'name' => $a->name,
            ];
        }

        $result = [
            'results' => $data,
            'pagination' => [
                'more' => $morePages
            ]
        ];

        return response()->json($result);
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
