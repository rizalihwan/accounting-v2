<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{TemplateJurnal, TemplateJurnalDetail};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator};

class TemplateJurnalController extends Controller
{
    private $template, $template_detail;

    public function __construct()
    {
        $this->template = new TemplateJurnal();
        $this->template_detail = new TemplateJurnalDetail();
    }

    public function index()
    {
        $data = $this->template->paginate(10);

        return view('admin.template-jurnal.index', compact('data'));
    }

    public function create()
    {
        return view('admin.template-jurnal.create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama_template' => 'required',
            'keterangan' => 'required',
            'kontak_id' => 'required|exists:kontaks,id',
            'divisi_id' => 'required|exists:divisis,id',
            'sumber' => 'required|in:KM,KK,JU',
            'frekuensi' => 'required|in:Harian,Bulanan,Tahunan',
            'per_tanggal' => 'required',
            'uraian' => 'required',
            'jurnals.*.akun_id' => 'required|exists:akuns,id',
            'jurnals.*.debit' => 'required_without:jurnals.*.kredit',
            'jurnals.*.kredit' => 'required_without:jurnals.*.debit',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        try {
            DB::transaction(function () use ($request) {
                $template = $this->template->create($request->except('jurnals'));

                foreach ($request->jurnals as $detail) {
                    $template_detail = $this->template_detail->create([
                        'template_id' => $template->id,
                        'akun_id' => $detail['akun_id'],
                        'debit' => $detail['debit'] == null ? '0' : preg_replace('/[^\d.]/', '', $detail['debit']),
                        'kredit' => $detail['kredit'] == null ? '0' : preg_replace('/[^\d.]/', '', $detail['kredit'])
                    ]);
                }
            });

            return redirect()->route('admin.template-jurnal.index')->with('success', 'Template berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $template = $this->template->findOrFail($id);

        try {
            $template->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->back()->with('success', 'Template berhasil dihapus');
    }
}
