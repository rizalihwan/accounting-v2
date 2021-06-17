<?php

namespace App\Http\Livewire\Admin\Unit;

use App\Models\Unit;
use Livewire\Component;

class Create extends Component
{
    public $name, $description, $status = 1;

    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string|max:255',
        'status' => 'sometimes'
    ];

    public function render()
    {
        return view('livewire.admin.unit.create');
    }

    public function resets()
    {
        $this->reset(['name', 'description', 'status']);
    }

    public function store()
    {
        $data = $this->validate();
        $data['status'] = (string)$data['status'];

        try {
            Unit::create($data);
            $this->emit('refresh', 'Data berhasil disimpan');
            $this->resets();
        } catch (\Throwable $th) {
            $this->emit('error', 'Data gagal disimpan');
        }
    }
}
