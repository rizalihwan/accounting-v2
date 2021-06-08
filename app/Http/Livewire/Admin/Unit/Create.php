<?php

namespace App\Http\Livewire\Admin\Unit;

use App\Models\Unit;
use Livewire\Component;

class Create extends Component
{
    public $name, $description, $status;

    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string|max:255'
    ];

    public function render()
    {
        return view('livewire.admin.unit.create');
    }

    public function resets()
    {
        $this->reset(['name', 'description']);
    }

    public function store()
    {
        $data = $this->validate();

        if ($this->status == null) {
            $this->status = '0';
        }

        $data["status"] = $this->status;

        try {
            Unit::create($data);
            $this->emit('refresh', 'Data berhasil disimpan');
            $this->resets();
        } catch (\Throwable $th) {
            $this->emit('error', 'Data gagal disimpan');
        }
    }
}
