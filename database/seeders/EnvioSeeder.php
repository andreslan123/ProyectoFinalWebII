<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnvioSeeder extends Seeder
{
    public function run()
    {
        DB::table('envios')->insert([
            ['id'=>1,'pedido_id'=>1,'metodo_envio'=>'Delivery local','codigo_seguimiento'=>'ENV-0001','empresa_envio'=>'Racing10 Express','fecha_envio'=>'2026-06-01 12:00:00','fecha_entrega'=>'2026-06-01 18:00:00','estado_id'=>21],
            ['id'=>2,'pedido_id'=>2,'metodo_envio'=>'Encomienda','codigo_seguimiento'=>'ENV-0002','empresa_envio'=>'Trans Copacabana','fecha_envio'=>'2026-06-02 13:00:00','fecha_entrega'=>null,'estado_id'=>20],
            ['id'=>3,'pedido_id'=>3,'metodo_envio'=>'Recojo en tienda','codigo_seguimiento'=>null,'empresa_envio'=>null,'fecha_envio'=>null,'fecha_entrega'=>null,'estado_id'=>19],
            ['id'=>4,'pedido_id'=>4,'metodo_envio'=>'Delivery local','codigo_seguimiento'=>'ENV-0004','empresa_envio'=>'Racing10 Express','fecha_envio'=>'2026-06-04 15:00:00','fecha_entrega'=>null,'estado_id'=>20],
            ['id'=>5,'pedido_id'=>5,'metodo_envio'=>'Encomienda','codigo_seguimiento'=>'ENV-0005','empresa_envio'=>'Bolivar Cargo','fecha_envio'=>null,'fecha_entrega'=>null,'estado_id'=>19],
            ['id'=>6,'pedido_id'=>6,'metodo_envio'=>'Delivery local','codigo_seguimiento'=>'ENV-0006','empresa_envio'=>'Racing10 Express','fecha_envio'=>'2026-06-06 17:00:00','fecha_entrega'=>'2026-06-06 20:00:00','estado_id'=>21],
            ['id'=>7,'pedido_id'=>7,'metodo_envio'=>'Recojo en tienda','codigo_seguimiento'=>null,'empresa_envio'=>null,'fecha_envio'=>null,'fecha_entrega'=>null,'estado_id'=>19],
            ['id'=>8,'pedido_id'=>8,'metodo_envio'=>'Encomienda','codigo_seguimiento'=>'ENV-0008','empresa_envio'=>'Trans Azul','fecha_envio'=>'2026-06-08 19:00:00','fecha_entrega'=>null,'estado_id'=>20],
            ['id'=>9,'pedido_id'=>9,'metodo_envio'=>'Delivery local','codigo_seguimiento'=>'ENV-0009','empresa_envio'=>'Racing10 Express','fecha_envio'=>null,'fecha_entrega'=>null,'estado_id'=>19],
            ['id'=>10,'pedido_id'=>10,'metodo_envio'=>'Encomienda','codigo_seguimiento'=>'ENV-0010','empresa_envio'=>'Bolivar Cargo','fecha_envio'=>'2026-06-09 20:00:00','fecha_entrega'=>null,'estado_id'=>20],
        ]);
    }
}