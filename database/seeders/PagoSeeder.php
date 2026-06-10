<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagoSeeder extends Seeder
{
    public function run()
    {
        DB::table('pagos')->insert([

            [
                'pedido_id' => 1,
                'estado_id' => 1,
                'metodo_pago' => 'QR',
                'monto' => 450
            ],

            [
                'pedido_id' => 2,
                'estado_id' => 1,
                'metodo_pago' => 'Tarjeta',
                'monto' => 320
            ],

            [
                'pedido_id' => 3,
                'estado_id' => 1,
                'metodo_pago' => 'Efectivo',
                'monto' => 170
            ]

        ]);
    }
}