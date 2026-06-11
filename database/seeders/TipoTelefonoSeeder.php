<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoTelefonoSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipos_telefono')->insert([
            ['id' => 1, 'nombre' => 'celular'],
            ['id' => 2, 'nombre' => 'fijo'],
            ['id' => 3, 'nombre' => 'whatsapp'],
        ]);
    }
}