<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{

    use WithPagination;
    public $search = null;
    protected $listeners = ['refresh', 'error', 'delete'];
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function refresh(string $message)
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => $message,
            'text' => '',
        ]);

        $this->search = '';
    }

    public function error(string $message)
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'error',
            'title' => $message,
            'text' => '',
        ]);

        $this->search = '';
    }

    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Apakah Anda yakin?',
            'text' => '',
            'id' => $id
        ]);
    }

    public function delete(Category $category)
    {
        $category->delete();

        $this->refresh('Data berhasil dihapus');
    }
    public function render(Category $category)
    {
        $categorys = $category->where('name', 'like', "%{$this->search}%")
            ->latest()->paginate(5);

        return view('livewire.admin.category.data', compact('categorys'));
    }
}
