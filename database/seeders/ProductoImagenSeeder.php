<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoImagenSeeder extends Seeder
{
    public function run()
    {
        DB::table('producto_imagenes')->insert([

            [
                'producto_id' => 1,
                'imagen' => 'piston.jpg',
                'principal' => 1
            ],

            [
                'producto_id' => 2,
                'imagen' => 'culata.jpg',
                'principal' => 1
            ],

            [
                'producto_id' => 3,
                'imagen' => 'pastillas.jpg',
                'principal' => 1
            ],

            [
                'producto_id' => 4,
                'imagen' => 'disco.jpg',
                'principal' => 1
            ],

            [
                'producto_id' => 5,
                'imagen' => 'amortiguador.jpg',
                'principal' => 1
            ]

        ]);
    }
}