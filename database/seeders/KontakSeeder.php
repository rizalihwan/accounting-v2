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
            'pemasok' => false,
            'karyawan' => false,
            'email' => 'pelanggan@gmail.com',
            'telepon' => '081234567890',
        ]);

        Kontak::create([
            'nama' => 'Pemasok',
            'pemasok' => true,
            'pelanggan' => false,
            'karyawan' => false,
            'email' => 'pemasok@gmail.com',
            'telepon' => '081234567890',
        ]);

        Kontak::create([
            'nama' => 'Karyawan',
            'karyawan' => true,
            'pelanggan' => false,
            'pemasok' => false,
            'email' => 'karyawan@gmail.com',
            'telepon' => '081234567890',
        ]);
    }
}
