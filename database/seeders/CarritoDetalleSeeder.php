<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarritoDetalleSeeder extends Seeder
{
    public function run()
    {
        DB::table('carrito_detalles')->insert([

            [
                'carrito_id' => 1,
                'producto_id' => 1,
                'cantidad' => 2
            ],

            [
                'carrito_id' => 1,
                'producto_id' => 3,
                'cantidad' => 1
            ],

            [
                'carrito_id' => 2,
                'producto_id' => 5,
                'cantidad' => 3
            ]

        ]);
    }
}