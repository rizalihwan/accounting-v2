<?php

namespace App\Http\Livewire\Admin\Subklasifikasi;

use App\Models\Subklasifikasi;
use Livewire\Component;

class Create extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required'
    ];

    public function render()
    {
        return view('livewire.admin.subklasifikasi.create');
    }

    public function store(Subklasifikasi $subklasifikasi)
    {
        $data = $this->validate();

        $subklasifikasi->create($data);

        $this->emit('refresh', 'Data berhasil disimpan');
        $this->name = null;
    }
}
