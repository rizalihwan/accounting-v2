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
        $units = [
            ["name" => "Jam", "description" => "Perjam"],
            ["name" => "Kg", "description" => "Kiilogran"],
            ["name" => "M", "description" => "Meter"],
            ["name" => "Rupiah", "description" => "Rupiah"],
            ["name" => "Bulan", "description" => "Bulan"]
        ];

        foreach ($units as $item) {
            Unit::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'status' => '1'
            ]);
        }
    }
}
