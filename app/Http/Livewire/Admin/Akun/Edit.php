<?php

namespace App\Http\Livewire\Admin\Akun;

use App\Models\Akun;
use Livewire\Component;

class Edit extends Component
{
    public $isOpen, $levels;
    public $akun;

    protected $listeners = ['edit'];

    protected $rules = [
        'akun.name' => 'required',
        'akun.subklasifikasi' => 'required',
        'akun.level' => 'required'
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
        $this->levels = ['Aktiva', 'Modal', 'Kewajiban', 'BiayaOperasional'];
    }

    public function update()
    {
        $this->validate(array_merge($this->rules, [
            'akun.name' => 'required',
            'akun.subklasifikasi' => 'required',
            'akun.level' => 'required|in:Aktiva,Modal,Kewajiban,BiayaOperasional'
        ]));

        try {
            $this->akun->save();
        } catch (\Exception $e) {
            $this->emit('error', 'Data gagal diedit');
        }

        $this->reset(['isOpen', 'akun']);
        $this->emit('refresh', 'Data berhasil diedit');
    }
}
