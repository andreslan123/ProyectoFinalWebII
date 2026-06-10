<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    public function run()
    {
        DB::table('pedidos')->insert([

            [
                'user_id' => 1,
                'estado_id' => 1,
                'codigo_pedido' => 'PED001',
                'total' => 450
            ],

            [
                'user_id' => 2,
                'estado_id' => 1,
                'codigo_pedido' => 'PED002',
                'total' => 320
            ],

            [
                'user_id' => 3,
                'estado_id' => 1,
                'codigo_pedido' => 'PED003',
                'total' => 170
            ]

        ]);
    }
}