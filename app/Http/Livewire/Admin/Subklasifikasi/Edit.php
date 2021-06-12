<?php

namespace App\Http\Livewire\Admin\Subklasifikasi;

use App\Models\Subklasifikasi;
use Livewire\Component;

class Edit extends Component
{
    public $isOpen;
    public $subklasifikasi;

    protected $listeners = ['edit'];

    protected $rules = [
        'subklasifikasi.name' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.subklasifikasi.edit');
    }

    public function edit(Subklasifikasi $subklasifikasi)
    {
        $this->isOpen = true;
        $this->subklasifikasi = $subklasifikasi;
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate(array_merge($this->rules, [
            'subklasifikasi.name' => 'required'
        ]));

        try {
            $this->category->save();
        } catch (\Throwable $th) {
            $this->emit('error', 'Data gagal diedit');
        }

        $this->emit('refresh', 'Data berhasil diedit');
        $this->reset('isOpen');
    }
}
