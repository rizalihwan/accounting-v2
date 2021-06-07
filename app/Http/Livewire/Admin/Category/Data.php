<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{

    use WithPagination;
    public $search = null;
    protected $listeners = ['refresh', 'delete'];
    protected $paginationTheme = 'bootstrap';

    public function refresh(string $message)
    {
        $this->search = null;
        session()->flash('success', $message);
    }

    public function delete(Category $category)
    {
        $category->delete();

        $this->refresh('Data berhasil dihapus');
    }
    public function render(Category $category)
    {
        
        $categorys = $category->where('name', 'like', "%{$this->search}%")
            ->latest()->paginate(10);

        return view('livewire.admin.category.data', compact('categorys'));
    }
}
