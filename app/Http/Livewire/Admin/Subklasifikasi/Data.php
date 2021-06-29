<?php

namespace App\Http\Livewire\Admin\Subklasifikasi;

use App\Models\Subklasifikasi;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refresh', 'error', 'delete'
    ];

    public $search = null;

    public function render()
    {
        $subklasifikasi = Subklasifikasi::where('name', 'like', "%{$this->search}%")
            ->latest()->paginate(5);

        return view('livewire.admin.subklasifikasi.data', compact('subklasifikasi'));
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

    public function delete(Subklasifikasi $subklasifikasi)
    {
        try {
            $subklasifikasi->delete();
            $this->refresh('Data berhasil dihapus');
        } catch (\Throwable $th) {
            $this->error('Data gagal dihapus');
        }
    }
}
