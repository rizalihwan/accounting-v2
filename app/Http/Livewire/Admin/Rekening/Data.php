<?php

namespace App\Http\Livewire\Admin\Rekening;

use App\Models\Rekening;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refresh', 'delete'
    ];

    public $search;

    public function render()
    {
        $rekenings = Rekening::where('nomor', 'like', "%{$this->search}%")
            ->orWhere('nama', 'like', "%{$this->search}%")
            ->latest()->paginate(15);

        return view('livewire.admin.rekening.data', compact('rekenings'));
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

    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Apakah Anda yakin?',
            'text' => '',
            'id' => $id
        ]);
    }

    public function delete(Rekening $rekening)
    {
        $rekening->delete();

        $this->refresh('Data berhasil dihapus');
    }
}
