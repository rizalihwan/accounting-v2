<?php

namespace App\Http\Livewire\Admin\Akun;

use App\Models\Akun;
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
        $accounts = Akun::where('kode', 'like', "%{$search}%")
            ->orWhere('name', 'like', "%{$search}%")
            ->orWhere('subklasifikasi', 'like', "%{$search}%")
            ->latest();

        $totalAkun = $accounts->count();
        $accounts = $accounts->paginate(5);

        return view('livewire.admin.akun.data', compact('totalAkun', 'accounts'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function refresh(string $message)
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Success',
            'text' => $message,
        ]);

        $this->search = '';
    }

    public function error(string $message)
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'error',
            'title' => 'Error',
            'text' => $message,
        ]);

        $this->search = '';
    }

    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Apakah Anda yakin?',
            'text' => 'Anda tidak dapat memulihkan data ini!',
            'id' => $id
        ]);
    }


    public function delete(Akun $akun)
    {
        try {
            $akun->delete();
            $this->emit('kodeOtomatis');
            $this->refresh('Data berhasil dihapus');
        } catch (\Exception $e) {
            $this->error('Data gagal dihapus');
        }
    }
}
