<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriaSeeder extends Seeder
{
    public function run()
    {
        $motores = DB::table('categorias')->where('nombre', 'Motores')->value('id');
        $frenos = DB::table('categorias')->where('nombre', 'Frenos')->value('id');
        $suspension = DB::table('categorias')->where('nombre', 'Suspension')->value('id');
        $transmision = DB::table('categorias')->where('nombre', 'Transmision')->value('id');
        $direccion = DB::table('categorias')->where('nombre', 'Direccion')->value('id');
        $electrico = DB::table('categorias')->where('nombre', 'Sistema Electrico')->value('id');
        $iluminacion = DB::table('categorias')->where('nombre', 'Iluminacion')->value('id');
        $filtros = DB::table('categorias')->where('nombre', 'Filtros')->value('id');

        DB::table('subcategorias')->insert([

            ['categoria_id' => $motores, 'nombre' => 'Pistones'],
            ['categoria_id' => $motores, 'nombre' => 'Culatas'],

            ['categoria_id' => $frenos, 'nombre' => 'Pastillas de Freno'],
            ['categoria_id' => $frenos, 'nombre' => 'Discos de Freno'],

            ['categoria_id' => $suspension, 'nombre' => 'Amortiguadores'],

            ['categoria_id' => $transmision, 'nombre' => 'Embragues'],

            ['categoria_id' => $direccion, 'nombre' => 'Rotulas'],

            ['categoria_id' => $electrico, 'nombre' => 'Baterias'],

            ['categoria_id' => $iluminacion, 'nombre' => 'Faros'],

            ['categoria_id' => $filtros, 'nombre' => 'Filtros de Aceite'],
        ]);
    }
}