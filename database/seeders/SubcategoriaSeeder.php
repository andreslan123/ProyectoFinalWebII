<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('subcategorias')->insert([
            ['id' => 1, 'categoria_id' => 1, 'nombre' => 'Aceites para motor'],
            ['id' => 2, 'categoria_id' => 2, 'nombre' => 'Filtros de aceite'],
            ['id' => 3, 'categoria_id' => 3, 'nombre' => 'Pastillas de freno'],
            ['id' => 4, 'categoria_id' => 4, 'nombre' => 'Bujias'],
            ['id' => 5, 'categoria_id' => 5, 'nombre' => 'Cadenas'],
            ['id' => 6, 'categoria_id' => 5, 'nombre' => 'Coronas y piñones'],
            ['id' => 7, 'categoria_id' => 6, 'nombre' => 'Llantas'],
            ['id' => 8, 'categoria_id' => 7, 'nombre' => 'Amortiguadores'],
            ['id' => 9, 'categoria_id' => 8, 'nombre' => 'Faros LED'],
            ['id' => 10, 'categoria_id' => 10, 'nombre' => 'Cascos integrales'],
        ]);
    }
}