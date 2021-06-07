<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Edit extends Component
{
    public $isOpen;
    public $category;

    protected $listeners = ['edit'];

    protected $rules = [
        'category.name' => 'required|unique:categories',
    ];

    public function edit(Category $category)
    {
        $this->isOpen = true;
        $this->category = $category;
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate(array_merge($this->rules, [
            'category.name' => 'required'
        ]));

        $this->category->save();

        $this->emit('refresh', 'Data berhasil diedit');
        $this->reset('isOpen');
    }

    public function render()
    {
        return view('livewire.admin.category.edit');
    }
}
