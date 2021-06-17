<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Create extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|unique:categories_products'
    ];

    private function clear()
    {
        $this->name = null;
    }

    public function store(Category $category)
    {
        $data = $this->validate();

        $category->create($data);

        $this->emit('refresh', 'Data berhasil disimpan');
        $this->clear();
    }

    public function render()
    {
        return view('livewire.admin.category.create');
    }
}
