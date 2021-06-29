<?php

namespace App\Http\Livewire\Admin\Akun;

use App\Models\Akun;
use App\Models\Subklasifikasi;
use Livewire\Component;

class Edit extends Component
{
    public $isOpen, $subklasifikasi, $levels;
    public $akun;

    protected $listeners = ['edit'];

    protected $rules = [
        'akun.name' => 'required',
        'akun.subklasifikasi_id' => 'required',
        'akun.level' => 'required',
        'akun.saldo_awal' => 'required'
    ];

    public function render()
    {
        return view('livewire.admin.akun.edit');
    }

    public function edit(Akun $akun)
    {
        $this->isOpen = true;
        $this->akun = $akun;
        $this->resetValidation();
    }

    public function mount()
    {
        $this->subklasifikasi = Subklasifikasi::select('id', 'name')->orderBy('name')->get();
        $this->levels = ['Aktiva', 'Modal', 'Kewajiban'];
    }

    public function update()
    {
        $this->validate(array_merge($this->rules, [
            'akun.name' => 'required',
            'akun.subklasifikasi_id' => 'required|exists:subklasifikasis,id',
            'akun.level' => 'required|in:Aktiva,Modal,Kewajiban',
            'akun.saldo_awal' => 'required|numeric'
        ]));

        try {
            $this->akun->save();
        } catch (\Throwable $th) {
            $this->emit('error', 'Data gagal diedit');
        }

        $this->reset(['isOpen', 'akun']);
        $this->emit('refresh', 'Data berhasil diedit');
    }
}
