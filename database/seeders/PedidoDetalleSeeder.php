<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoDetalleSeeder extends Seeder
{
    public function run()
    {
        DB::table('pedido_detalles')->insert([

            [
                'pedido_id' => 1,
                'producto_id' => 1,
                'cantidad' => 1
            ],

            [
                'pedido_id' => 1,
                'producto_id' => 2,
                'cantidad' => 1
            ],

            [
                'pedido_id' => 2,
                'producto_id' => 6,
                'cantidad' => 1
            ],

            [
                'pedido_id' => 3,
                'producto_id' => 5,
                'cantidad' => 1
            ]

        ]);
    }
}