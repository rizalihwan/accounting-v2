<?php

namespace App\Http\Livewire\Admin\Unit;

use App\Models\Unit;
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
        $search = $this->search;
        $unit = Unit::where('name', 'like', "%{$search}%")->latest();
        $totalUnit = $unit->count();
        $units = $unit->paginate(5);

        return view('livewire.admin.unit.data', compact('units', 'unit', 'totalUnit'));
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

    public function delete(Unit $unit)
    {
        try {
            $unit->delete();
            $this->refresh('Data berhasil dihapus');
        } catch (\Throwable $th) {
            $this->error('Data gagal dihapus');
        }
    }
}
