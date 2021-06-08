<?php

namespace App\Http\Livewire\Admin\Rekening;

use App\Models\Bank;
use App\Models\Divisi;
use App\Models\Rekening;
use Livewire\Component;

class CreateForm extends Component
{
    public $nomor, $nama, $level, $d_c, $g_d, $mata_uang;
    public $bank_id, $kategori, $ac_bank, $divisi_id;
    public $aktif = true, $piutang = false, $kas_bank = false;
    public $level_1, $level_2, $level_3;

    protected $rules = [
        'nomor' => 'required|min:4|max:4|unique:rekenings',
        'nama' => 'required|string',
        'level' => 'required',
        'd_c' => 'required|in:,D,C',
        'g_d' => 'required|in:G,D',
        'mata_uang' => 'required|in:Rp,USD',
        'bank_id' => 'required|exists:banks,id',
        'kategori' => 'required|in:Aktiva,Hutang,Modal,Pendapatan,Biaya',
        'ac_bank' => 'required',
        'divisi_id' => 'required|exists:divisis,id',
        'level_1' => 'required|in:1000,2000,3000,4000,5000',
    ];

    public function render()
    {
        $banks = Bank::select('id', 'nama_bank', 'created_at')->orderBy('nama_bank')->get();
        $divitions = Divisi::select('id', 'nama', 'created_at')->orderBy('nama')->get();

        return view('livewire.admin.rekening.create-form', compact('banks', 'divitions'));
    }

    public function cekDC()
    {
        $kategori = $this->kategori;

        if (
            $kategori == 'Hutang' ||
            $kategori == 'Modal' ||
            $kategori == 'Pendapatan'
        ) {
            $this->d_c = 'C';
        } elseif ($kategori == 'Aktiva' || $kategori == 'Biaya') {
            $this->d_c = 'D';
        }
    }

    public function store()
    {
        $data = $this->validate();

        $data = collect($data)->merge([
            'level_2' => $this->level_2,
            'level_3' => $this->level_3,
            'aktif' => $this->aktif,
            'piutang' => $this->piutang,
            'kas_bank' => $this->kas_bank
        ])->toArray();

        try {
            Rekening::create($data);
            session()->flash('success', 'Data berhasil disimpan');
            return redirect()->to('/admin/rekening');
        } catch (\Throwable $th) {
            session()->flash('error', 'Something wrong.');
        }
    }
}
