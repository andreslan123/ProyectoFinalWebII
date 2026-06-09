<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['nombre' => 'Administrador'],
            ['nombre' => 'Cliente'],
            ['nombre' => 'Vendedor'],
            ['nombre' => 'cliente'],
            ['nombre' => 'cleinte'],
            ['nombre' => 'cliente'],
            ['nombre' => 'cliente'],
            ['nombre' => 'cliente'],
            ['nombre' => 'Vendedor'],
            ['nombre' => 'Cliente']
        ]);
    }
}