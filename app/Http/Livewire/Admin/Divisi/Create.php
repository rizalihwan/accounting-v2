<?php

namespace App\Http\Livewire\Admin\Divisi;

use App\Models\Divisi;
use Livewire\Component;

class Create extends Component
{
    public $kode, $nama;

    protected $rules = [
        'kode' => 'required|min:4|unique:divisis',
        'nama' => 'required'
    ];

    private function clear()
    {
        $this->kode = null;
        $this->nama = null;
    }

    public function render()
    {
        return view('livewire.admin.divisi.create');
    }

    public function store(Divisi $divisi)
    {
        $data = $this->validate();

        $divisi->create($data);

        $this->emit('refresh', 'Data berhasil disimpan');
        $this->clear();
    }
}
