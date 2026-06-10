<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoTelefonoSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipos_telefono')->insert([

            ['nombre'=>'Celular'],
            ['nombre'=>'Casa'],
            ['nombre'=>'Trabajo']

        ]);
    }
}