<?php

namespace Database\Seeders;

use App\Models\Subklasifikasi;
use Illuminate\Database\Seeder;

class SubklasifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subklasifikasi::create([
            'name' => 'Kas'
        ]);

        Subklasifikasi::create([
            'name' => 'Piutang'
        ]);
    }
}
