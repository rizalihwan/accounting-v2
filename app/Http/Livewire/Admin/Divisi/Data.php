<?php

namespace App\Http\Livewire\Admin\Divisi;

use App\Models\Divisi;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $search = null;

    protected $listeners = ['refresh', 'delete'];
    protected $paginationTheme = 'bootstrap';

    public function render(Divisi $divitions)
    {
        $divitions = $divitions->where('nama', 'like', "%{$this->search}%")
            ->orWhere('kode', 'like', "%{$this->search}%")
            ->latest()->paginate(10);

        return view('livewire.admin.divisi.data', compact('divitions'));
    }

    public function refresh(string $message)
    {
        $this->search = null;
        session()->flash('success', $message);
    }

    public function delete(Divisi $divisi)
    {
        $divisi->delete();

        $this->refresh('Data berhasil dihapus');
    }
}
