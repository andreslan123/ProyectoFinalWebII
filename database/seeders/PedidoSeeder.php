<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    public function run()
    {
        DB::table('pedidos')->insert([
            ['id'=>1,'user_id'=>2,'estado_id'=>13,'fecha_pedido'=>'2026-06-01 10:00:00','total'=>235.00],
            ['id'=>2,'user_id'=>3,'estado_id'=>12,'fecha_pedido'=>'2026-06-02 11:00:00','total'=>250.00],
            ['id'=>3,'user_id'=>4,'estado_id'=>10,'fecha_pedido'=>'2026-06-03 12:00:00','total'=>260.00],
            ['id'=>4,'user_id'=>5,'estado_id'=>11,'fecha_pedido'=>'2026-06-04 13:00:00','total'=>460.00],
            ['id'=>5,'user_id'=>6,'estado_id'=>9,'fecha_pedido'=>'2026-06-05 14:00:00','total'=>400.00],
            ['id'=>6,'user_id'=>7,'estado_id'=>13,'fecha_pedido'=>'2026-06-06 15:00:00','total'=>300.00],
            ['id'=>7,'user_id'=>8,'estado_id'=>10,'fecha_pedido'=>'2026-06-07 16:00:00','total'=>210.00],
            ['id'=>8,'user_id'=>9,'estado_id'=>12,'fecha_pedido'=>'2026-06-08 17:00:00','total'=>390.00],
            ['id'=>9,'user_id'=>10,'estado_id'=>9,'fecha_pedido'=>'2026-06-09 18:00:00','total'=>255.00],
            ['id'=>10,'user_id'=>2,'estado_id'=>10,'fecha_pedido'=>'2026-06-09 19:00:00','total'=>500.00],
        ]);
    }
}