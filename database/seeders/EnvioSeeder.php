<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnvioSeeder extends Seeder
{
    public function run()
    {
        DB::table('envios')->insert([

            [
                'pedido_id' => 1,
                'estado_id' => 1,
                'metodo_envio' => 'Delivery',
                'codigo_seguimiento' => 'ENV001',
                'empresa_envio' => 'TransBol',
                'costo_envio' => 20
            ],

            [
                'pedido_id' => 2,
                'estado_id' => 1,
                'metodo_envio' => 'Delivery',
                'codigo_seguimiento' => 'ENV002',
                'empresa_envio' => 'TransBol',
                'costo_envio' => 25
            ],

            [
                'pedido_id' => 3,
                'estado_id' => 1,
                'metodo_envio' => 'Recojo',
                'codigo_seguimiento' => null,
                'empresa_envio' => null,
                'costo_envio' => 0
            ]

        ]);
    }
}