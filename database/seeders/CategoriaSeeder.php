<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Motores'],
            ['nombre' => 'Frenos'],
            ['nombre' => 'Suspension'],
            ['nombre' => 'Transmision'],
            ['nombre' => 'Direccion'],
            ['nombre' => 'Sistema Electrico'],
            ['nombre' => 'Iluminacion'],
            ['nombre' => 'Lubricantes'],
            ['nombre' => 'Filtros'],
            ['nombre' => 'Accesorios']
        ]);
    }
}