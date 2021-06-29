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
            ->orWhereHas('subklasifikasi', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('level', 'like', "%{$search}%")
            ->orWhere('saldo_awal', 'like', "%{$search}%")
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


    public function delete(Akun $akun)
    {
        try {
            $akun->delete();
            $this->emit('kodeOtomatis');
            $this->refresh('Data berhasil dihapus');
        } catch (\Throwable $th) {
            $this->error('Data gagal dihapus');
        }
    }
}
