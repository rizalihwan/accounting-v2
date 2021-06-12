<?php

namespace App\Http\Livewire\Admin\Divisi;

use App\Models\Divisi;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $search = null;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refresh', 'error', 'delete'
    ];

    public function render(Divisi $divitions)
    {
        $divitions = $divitions->where('nama', 'like', "%{$this->search}%")
            ->orWhere('kode', 'like', "%{$this->search}%")
            ->latest()->paginate(5);

        return view('livewire.admin.divisi.data', compact('divitions'));
    }

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

    public function delete(Divisi $divisi)
    {
        $divisi->delete();

        $this->refresh('Data berhasil dihapus');
    }
}
