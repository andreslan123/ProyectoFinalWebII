<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoDetalleSeeder extends Seeder
{
    public function run()
    {
        DB::table('pedido_detalles')->insert([
            ['id'=>1,'pedido_id'=>1,'producto_id'=>1,'cantidad'=>1],
            ['id'=>2,'pedido_id'=>2,'producto_id'=>3,'cantidad'=>2],
            ['id'=>3,'pedido_id'=>3,'producto_id'=>5,'cantidad'=>1],
            ['id'=>4,'pedido_id'=>4,'producto_id'=>8,'cantidad'=>1],
            ['id'=>5,'pedido_id'=>5,'producto_id'=>10,'cantidad'=>3],
            ['id'=>6,'pedido_id'=>6,'producto_id'=>2,'cantidad'=>1],
            ['id'=>7,'pedido_id'=>7,'producto_id'=>7,'cantidad'=>2],
            ['id'=>8,'pedido_id'=>8,'producto_id'=>4,'cantidad'=>1],
            ['id'=>9,'pedido_id'=>9,'producto_id'=>9,'cantidad'=>1],
            ['id'=>10,'pedido_id'=>10,'producto_id'=>6,'cantidad'=>1],
        ]);
    }
}