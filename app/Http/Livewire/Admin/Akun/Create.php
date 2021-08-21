<?php

namespace App\Http\Livewire\Admin\Akun;

use Livewire\Component;
use App\Models\Akun;

class Create extends Component
{
    public $kode, $name, $subklasifikasi, $level;

    public $levels = [];

    protected $listeners = [
        'kodeOtomatis'
    ];

    protected $rules = [
        'kode' => 'required|min:4|unique:akuns',
        'name' => 'required',
        'subklasifikasi' => 'required',
        'level' => 'required|in:Aktiva,Modal,Kewajiban,BiayaOperasional'
    ];

    public function kodeOtomatis()
    {
        $number = Akun::count();
        if ($number > 0) {
            $number = Akun::max('kode');
            $strnum = substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'AC' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'AC' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'AC' . "00" . $strnum;
            }
        } else {
            $kode = 'AC' . "001";
        }

        $this->kode = $kode;
    }

    public function mount()
    {
        $this->kodeOtomatis();
        $this->levels = ['Aktiva', 'Modal', 'Kewajiban', 'BiayaOperasional'];
    }

    public function render()
    {
        return view('livewire.admin.akun.create');
    }

    public function store()
    {
        $data = $this->validate();

        try {
            Akun::create($data);
        } catch (\Throwable $th) {
            $this->emit('error', 'Data gagal disimpan');
        }

        $this->emit('refresh', 'Data berhasil disimpan');
        $this->reset('name', 'subklasifikasi', 'level');
        $this->kodeOtomatis();
    }
}
