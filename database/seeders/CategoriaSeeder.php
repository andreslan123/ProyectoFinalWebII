<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('categorias')->insert([
            ['id' => 1, 'nombre' => 'Lubricantes'],
            ['id' => 2, 'nombre' => 'Filtros'],
            ['id' => 3, 'nombre' => 'Frenos'],
            ['id' => 4, 'nombre' => 'Sistema Electrico'],
            ['id' => 5, 'nombre' => 'Transmision'],
            ['id' => 6, 'nombre' => 'Neumaticos'],
            ['id' => 7, 'nombre' => 'Suspension'],
            ['id' => 8, 'nombre' => 'Iluminacion'],
            ['id' => 9, 'nombre' => 'Accesorios'],
            ['id' => 10, 'nombre' => 'Cascos'],
        ]);
    }
}