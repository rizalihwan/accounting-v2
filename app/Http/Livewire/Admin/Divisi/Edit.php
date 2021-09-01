<?php

namespace App\Http\Livewire\Admin\Divisi;

use Livewire\Component;
use App\Models\Divisi;

class Edit extends Component
{
    public $isOpen;
    public $divisi;

    protected $listeners = ['edit'];

    protected $rules = [
        'divisi.kode' => 'required|min:4',
        'divisi.nama' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.divisi.edit');
    }

    public function edit(Divisi $divisi)
    {
        $this->isOpen = true;
        $this->divisi = $divisi;
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate(array_merge($this->rules, [
            'divisi.kode' => 'required|string|min:4|unique:divisis,kode,' . $this->divisi->id,
            'divisi.nama' => 'required'
        ]));

        try {
            $this->divisi->save();
        } catch (\Exception $e) {
            $this->emit('error', 'Data gagal diedit');
        }

        $this->reset(['isOpen', 'akun']);
        $this->emit('refresh', 'Data berhasil diedit');
    }
}
