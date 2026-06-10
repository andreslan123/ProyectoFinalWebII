<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResenaSeeder extends Seeder
{
    public function run()
    {
        DB::table('resenas')->insert([

            [
                'user_id' => 1,
                'producto_id' => 1,
                'estado_id' => 1,
                'calificacion' => 5,
                'comentario' => 'Excelente calidad'
            ],

            [
                'user_id' => 2,
                'producto_id' => 3,
                'estado_id' => 1,
                'calificacion' => 4,
                'comentario' => 'Muy buen producto'
            ],

            [
                'user_id' => 3,
                'producto_id' => 5,
                'estado_id' => 1,
                'calificacion' => 5,
                'comentario' => 'Recomendado'
            ]

        ]);
    }
}