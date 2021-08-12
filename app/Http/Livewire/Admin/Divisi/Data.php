<?php

namespace App\Http\Livewire\Admin\Divisi;

use App\Models\Divisi;
use App\Models\Jurnalumum;
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

    public function render(Divisi $divitions)
    {
        $divition = $divitions->where('nama', 'like', "%{$this->search}%")
            ->orWhere('kode', 'like', "%{$this->search}%")
            ->latest();
        $totalDivition = $divition->count();
        $divitions = $divition->paginate(5);

        return view('livewire.admin.divisi.data', compact('divitions', 'totalDivition'));
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
        try {
            // sintak dibawah masih salah dan.
            // jadi kalau si divisi punya jurnalumum pas hapus data selected ke hapus juga si ju nya.
            if($divisi->jurnalumums())
            {
                $divisi->jurnalumums()->delete();
            }
            
            $divisi->delete();
            
            $this->refresh('Data berhasil dihapus');
        } catch (\Throwable $th) {
            $this->error('Data gagal dihapus' . $th->getMessage());
        }
    }
}
