<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MovimientoStockSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('movimientos_stock')->insert([
            ['id'=>1,'producto_id'=>1,'tipo_movimiento'=>'Entrada','cantidad'=>50,'motivo'=>'Compra inicial de aceite Honda.','descripcion'=>null,'fecha_movimiento'=>'2026-06-01 08:00:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>2,'producto_id'=>1,'tipo_movimiento'=>'Salida','cantidad'=>10,'motivo'=>'Ventas realizadas durante la semana.','descripcion'=>null,'fecha_movimiento'=>'2026-06-07 18:00:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>3,'producto_id'=>2,'tipo_movimiento'=>'Entrada','cantidad'=>40,'motivo'=>'Ingreso de filtros de aceite.','descripcion'=>null,'fecha_movimiento'=>'2026-06-01 08:10:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>4,'producto_id'=>2,'tipo_movimiento'=>'Salida','cantidad'=>5,'motivo'=>'Salida por pedidos de clientes.','descripcion'=>null,'fecha_movimiento'=>'2026-06-07 18:10:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>5,'producto_id'=>3,'tipo_movimiento'=>'Entrada','cantidad'=>30,'motivo'=>'Ingreso de pastillas de freno.','descripcion'=>null,'fecha_movimiento'=>'2026-06-01 08:20:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>6,'producto_id'=>3,'tipo_movimiento'=>'Salida','cantidad'=>5,'motivo'=>'Venta en tienda.','descripcion'=>null,'fecha_movimiento'=>'2026-06-07 18:20:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>7,'producto_id'=>4,'tipo_movimiento'=>'Entrada','cantidad'=>70,'motivo'=>'Ingreso de bujias NGK.','descripcion'=>null,'fecha_movimiento'=>'2026-06-01 08:30:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>8,'producto_id'=>4,'tipo_movimiento'=>'Salida','cantidad'=>10,'motivo'=>'Salida por mantenimiento preventivo.','descripcion'=>null,'fecha_movimiento'=>'2026-06-07 18:30:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>9,'producto_id'=>5,'tipo_movimiento'=>'Entrada','cantidad'=>20,'motivo'=>'Ingreso de cadenas reforzadas.','descripcion'=>null,'fecha_movimiento'=>'2026-06-01 08:40:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>10,'producto_id'=>5,'tipo_movimiento'=>'Salida','cantidad'=>2,'motivo'=>'Venta de cadenas.','descripcion'=>null,'fecha_movimiento'=>'2026-06-07 18:40:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>11,'producto_id'=>6,'tipo_movimiento'=>'Entrada','cantidad'=>25,'motivo'=>'Ingreso de coronas Bajaj.','descripcion'=>null,'fecha_movimiento'=>'2026-06-01 08:50:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>12,'producto_id'=>6,'tipo_movimiento'=>'Salida','cantidad'=>5,'motivo'=>'Ventas de transmision.','descripcion'=>null,'fecha_movimiento'=>'2026-06-07 18:50:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>13,'producto_id'=>7,'tipo_movimiento'=>'Entrada','cantidad'=>15,'motivo'=>'Ingreso de llantas tubeless.','descripcion'=>null,'fecha_movimiento'=>'2026-06-01 09:00:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>14,'producto_id'=>7,'tipo_movimiento'=>'Salida','cantidad'=>3,'motivo'=>'Ventas de llantas.','descripcion'=>null,'fecha_movimiento'=>'2026-06-07 19:00:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>15,'producto_id'=>8,'tipo_movimiento'=>'Entrada','cantidad'=>18,'motivo'=>'Ingreso de amortiguadores.','descripcion'=>null,'fecha_movimiento'=>'2026-06-01 09:10:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>16,'producto_id'=>8,'tipo_movimiento'=>'Salida','cantidad'=>3,'motivo'=>'Venta de amortiguadores.','descripcion'=>null,'fecha_movimiento'=>'2026-06-07 19:10:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>17,'producto_id'=>9,'tipo_movimiento'=>'Entrada','cantidad'=>25,'motivo'=>'Ingreso de faros LED.','descripcion'=>null,'fecha_movimiento'=>'2026-06-01 09:20:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>18,'producto_id'=>9,'tipo_movimiento'=>'Salida','cantidad'=>3,'motivo'=>'Venta de faros LED.','descripcion'=>null,'fecha_movimiento'=>'2026-06-07 19:20:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>19,'producto_id'=>10,'tipo_movimiento'=>'Entrada','cantidad'=>12,'motivo'=>'Ingreso de cascos integrales.','descripcion'=>null,'fecha_movimiento'=>'2026-06-01 09:30:00','created_at'=>$now,'updated_at'=>$now],
            ['id'=>20,'producto_id'=>10,'tipo_movimiento'=>'Salida','cantidad'=>2,'motivo'=>'Venta de cascos.','descripcion'=>null,'fecha_movimiento'=>'2026-06-07 19:30:00','created_at'=>$now,'updated_at'=>$now],
        ]);
    }
}