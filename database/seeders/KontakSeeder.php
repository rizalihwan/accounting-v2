<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kontak::create([
            'nama' => 'Pelanggan',
            'pelanggan' => true,
            'email' => 'pelanggan@gmail.com',
            'telepon' => '081234567890',
        ]);

        Kontak::create([
            'nama' => 'Pemasok',
            'pemasok' => true,
            'email' => 'pemasok@gmail.com',
            'telepon' => '081234567890',
        ]);

        Kontak::create([
            'nama' => 'Karyawan',
            'karyawan' => true,
            'email' => 'karyawan@gmail.com',
            'telepon' => '081234567890',
        ]);

        Kontak::create([
            'nama' => 'Nasabah',
            'nasabah' => true,
            'email' => 'nasabah@gmail.com',
            'telepon' => '081234567890',
            'kode_kontak' => 'N-00001',
            'alamat' => 'Sillicon Valley',
            'pekerjaan' => 'AI Engineer'
        ]);

        Kontak::create([
            'nama' => 'Petugas',
            'petugas' => true,
            'email' => 'nasabah@gmail.com',
            'telepon' => '081234567890',
        ]);
    }
}
