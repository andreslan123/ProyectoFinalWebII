<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovimientoStockSeeder extends Seeder
{
    public function run()
    {
        DB::table('movimientos_stock')->insert([

            [
                'producto_id' => 1,
                'tipo_movimiento_id' => 1,
                'cantidad' => 50,
                'motivo' => 'Ingreso inicial'
            ],

            [
                'producto_id' => 2,
                'tipo_movimiento_id' => 1,
                'cantidad' => 40,
                'motivo' => 'Ingreso inicial'
            ],

            [
                'producto_id' => 3,
                'tipo_movimiento_id' => 2,
                'cantidad' => 5,
                'motivo' => 'Venta'
            ],

            [
                'producto_id' => 4,
                'tipo_movimiento_id' => 2,
                'cantidad' => 3,
                'motivo' => 'Venta'
            ]

        ]);
    }
}