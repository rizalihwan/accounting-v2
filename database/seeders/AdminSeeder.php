<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin ganteng',
            'username' => 'adminganteng',
            'password' => 'adminganteng',
            'role' => 'admin',
        ]);
    }
}
