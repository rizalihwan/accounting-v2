<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'name' => 'Jam',
            'description' => 'Perjam'
        ]);

        Unit::create([
            'name' => 'Kg',
            'description' => 'Kilogram'
        ]);

        Unit::create([
            'name' => 'M',
            'description' => 'Meter'
        ]);
    }
}
