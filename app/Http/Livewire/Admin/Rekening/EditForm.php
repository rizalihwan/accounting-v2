<?php

namespace App\Http\Livewire\Admin\Rekening;

use App\Models\Rekening;
use App\Models\Bank;
use App\Models\Divisi;
use Livewire\Component;

class EditForm extends Component
{
    public $rekening;

    protected $rules = [
        'rekening.nomor' => 'required',
        'rekening.nama' => 'required|string',
        'rekening.level' => 'required',
        'rekening.d_c' => 'required',
        'rekening.g_d' => 'required',
        'rekening.mata_uang' => 'required',
        'rekening.bank_id' => 'required',
        'rekening.kategori' => 'required',
        'rekening.ac_bank' => 'required',
        'rekening.divisi_id' => 'required',
        'rekening.aktif' => 'boolean',
        'rekening.piutang' => 'boolean',
        'rekening.kas_bank' => 'boolean',
        'rekening.level_1' => 'required',
        'rekening.level_2' => 'string',
        'rekening.level_3' => 'string',
    ];

    public function render()
    {
        $banks = Bank::select('id', 'nama_bank', 'created_at')->orderBy('nama_bank')->get();
        $divitions = Divisi::select('id', 'nama', 'created_at')->orderBy('nama')->get();

        return view('livewire.admin.rekening.edit-form', compact('banks', 'divitions'));
    }

    public function cekDC()
    {
        $kategori = $this->rekening->kategori;

        if (
            $kategori == 'Hutang' ||
            $kategori == 'Modal' ||
            $kategori == 'Pendapatan'
        ) {
            $this->rekening->d_c = 'C';
        } elseif ($kategori == 'Aktiva' || $kategori == 'Biaya') {
            $this->rekening->d_c = 'D';
        }
    }

    public function update()
    {
        $data = $this->validate(array_merge($this->rules, [
            'rekening.nomor' => 'required|min:4|max:4|unique:rekenings,nomor,' . $this->rekening->id,
            'rekening.nama' => 'required|string',
            'rekening.level' => 'required',
            'rekening.d_c' => 'required|in:,D,C',
            'rekening.g_d' => 'required|in:G,D',
            'rekening.mata_uang' => 'required|in:Rp,USD',
            'rekening.bank_id' => 'required|exists:banks,id',
            'rekening.kategori' => 'required|in:Aktiva,Hutang,Modal,Pendapatan,Biaya',
            'rekening.divisi_id' => 'required|exists:divisis,id',
            'rekening.aktif' => 'boolean',
            'rekening.piutang' => 'boolean',
            'rekening.kas_bank' => 'boolean',
            'rekening.level_1' => 'required|in:1000,2000,3000,4000,5000',
            'rekening.level_2' => 'string',
            'rekening.level_3' => 'string',
        ]));

        try {
            $this->rekening->save();
            session()->flash('success', 'Data berhasil diubah');
            return redirect()->to('/admin/rekening');
        } catch (\Throwable $th) {
            session()->flash('error', 'Something wrong.');
        }
    }
}
