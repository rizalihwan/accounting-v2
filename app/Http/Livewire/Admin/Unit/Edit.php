<?php

namespace App\Http\Livewire\Admin\Unit;

use App\Models\Unit;
use Livewire\Component;

class Edit extends Component
{
    public $isOpen;
    public $unit;

    protected $listeners = ['edit'];

    protected $rules = [
        'unit.name' => 'required',
        'unit.description' => 'required',
        'unit.status' => 'in:1,0'
    ];

    public function render()
    {
        return view('livewire.admin.unit.edit');
    }

    public function edit(Unit $unit)
    {
        $this->isOpen = true;
        $this->unit = $unit;
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate(array_merge($this->rules, [
            'unit.name' => 'required|string',
            'unit.description' => 'required|string',
            'unit.status' => 'in:1,0'
        ]));

        try {
            $this->unit->save();
        } catch (\Throwable $th) {
            $this->emit('error', 'Data gagal diedit');
        }

        $this->reset(['isOpen', 'unit']);
        $this->emit('refresh', 'Data berhasil diedit');
    }
}
