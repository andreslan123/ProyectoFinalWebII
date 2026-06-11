<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'admin'],
            ['id' => 2, 'nombre' => 'cliente'],
            ['id' => 3, 'nombre' => 'vendedor'],
        ]);
    }
}