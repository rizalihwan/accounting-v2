<?php

namespace App\Imports;

use App\Models\Simpan;
use Maatwebsite\Excel\Concerns\ToModel;

class SimpanImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Simpan([
            'keterangan' => $row[1],
            'kontak_id' => $row[2],
            'jenis_simpanan' => $row[3],
            'no_rekening' => $row[4],
            'administrasi' => $row[5],
            'setoran' => $row[6],
            'petugas' => $row[7]
        ]);
    }
}
