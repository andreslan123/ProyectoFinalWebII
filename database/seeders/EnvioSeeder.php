<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnvioSeeder extends Seeder
{
    public function run()
    {
        DB::table('envios')->insert([
            ['id'=>1,'pedido_id'=>1,'estado_id'=>21,'metodo_envio'=>'Delivery local','codigo_seguimiento'=>'ENV-0001','empresa_envio'=>'Racing10 Express','costo_envio'=>15.00,'fecha_envio'=>'2026-06-01 12:00:00','fecha_entrega'=>'2026-06-01 18:00:00'],
            ['id'=>2,'pedido_id'=>2,'estado_id'=>20,'metodo_envio'=>'Encomienda','codigo_seguimiento'=>'ENV-0002','empresa_envio'=>'Trans Copacabana','costo_envio'=>25.00,'fecha_envio'=>'2026-06-02 13:00:00','fecha_entrega'=>null],
            ['id'=>3,'pedido_id'=>3,'estado_id'=>19,'metodo_envio'=>'Recojo en tienda','codigo_seguimiento'=>null,'empresa_envio'=>null,'costo_envio'=>0.00,'fecha_envio'=>null,'fecha_entrega'=>null],
            ['id'=>4,'pedido_id'=>4,'estado_id'=>20,'metodo_envio'=>'Delivery local','codigo_seguimiento'=>'ENV-0004','empresa_envio'=>'Racing10 Express','costo_envio'=>15.00,'fecha_envio'=>'2026-06-04 15:00:00','fecha_entrega'=>null],
            ['id'=>5,'pedido_id'=>5,'estado_id'=>19,'metodo_envio'=>'Encomienda','codigo_seguimiento'=>'ENV-0005','empresa_envio'=>'Bolivar Cargo','costo_envio'=>30.00,'fecha_envio'=>null,'fecha_entrega'=>null],
            ['id'=>6,'pedido_id'=>6,'estado_id'=>21,'metodo_envio'=>'Delivery local','codigo_seguimiento'=>'ENV-0006','empresa_envio'=>'Racing10 Express','costo_envio'=>15.00,'fecha_envio'=>'2026-06-06 17:00:00','fecha_entrega'=>'2026-06-06 20:00:00'],
            ['id'=>7,'pedido_id'=>7,'estado_id'=>19,'metodo_envio'=>'Recojo en tienda','codigo_seguimiento'=>null,'empresa_envio'=>null,'costo_envio'=>0.00,'fecha_envio'=>null,'fecha_entrega'=>null],
            ['id'=>8,'pedido_id'=>8,'estado_id'=>20,'metodo_envio'=>'Encomienda','codigo_seguimiento'=>'ENV-0008','empresa_envio'=>'Trans Azul','costo_envio'=>28.00,'fecha_envio'=>'2026-06-08 19:00:00','fecha_entrega'=>null],
            ['id'=>9,'pedido_id'=>9,'estado_id'=>19,'metodo_envio'=>'Delivery local','codigo_seguimiento'=>'ENV-0009','empresa_envio'=>'Racing10 Express','costo_envio'=>15.00,'fecha_envio'=>null,'fecha_entrega'=>null],
            ['id'=>10,'pedido_id'=>10,'estado_id'=>20,'metodo_envio'=>'Encomienda','codigo_seguimiento'=>'ENV-0010','empresa_envio'=>'Bolivar Cargo','costo_envio'=>30.00,'fecha_envio'=>'2026-06-09 20:00:00','fecha_entrega'=>null],
        ]);
    }
}