<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovimientoStockSeeder extends Seeder
{
    public function run()
    {
        DB::table('movimientos_stock')->insert([
            ['id'=>1,'producto_id'=>1,'tipo_movimiento_id'=>29,'cantidad'=>50,'motivo'=>'Compra inicial de aceite Honda.','fecha_movimiento'=>'2026-06-01 08:00:00'],
            ['id'=>2,'producto_id'=>1,'tipo_movimiento_id'=>30,'cantidad'=>10,'motivo'=>'Ventas realizadas durante la semana.','fecha_movimiento'=>'2026-06-07 18:00:00'],
            ['id'=>3,'producto_id'=>2,'tipo_movimiento_id'=>29,'cantidad'=>40,'motivo'=>'Ingreso de filtros de aceite.','fecha_movimiento'=>'2026-06-01 08:10:00'],
            ['id'=>4,'producto_id'=>2,'tipo_movimiento_id'=>30,'cantidad'=>5,'motivo'=>'Salida por pedidos de clientes.','fecha_movimiento'=>'2026-06-07 18:10:00'],
            ['id'=>5,'producto_id'=>3,'tipo_movimiento_id'=>29,'cantidad'=>30,'motivo'=>'Ingreso de pastillas de freno.','fecha_movimiento'=>'2026-06-01 08:20:00'],
            ['id'=>6,'producto_id'=>3,'tipo_movimiento_id'=>30,'cantidad'=>5,'motivo'=>'Venta en tienda.','fecha_movimiento'=>'2026-06-07 18:20:00'],
            ['id'=>7,'producto_id'=>4,'tipo_movimiento_id'=>29,'cantidad'=>70,'motivo'=>'Ingreso de bujias NGK.','fecha_movimiento'=>'2026-06-01 08:30:00'],
            ['id'=>8,'producto_id'=>4,'tipo_movimiento_id'=>30,'cantidad'=>10,'motivo'=>'Salida por mantenimiento preventivo.','fecha_movimiento'=>'2026-06-07 18:30:00'],
            ['id'=>9,'producto_id'=>5,'tipo_movimiento_id'=>29,'cantidad'=>20,'motivo'=>'Ingreso de cadenas reforzadas.','fecha_movimiento'=>'2026-06-01 08:40:00'],
            ['id'=>10,'producto_id'=>5,'tipo_movimiento_id'=>30,'cantidad'=>2,'motivo'=>'Venta de cadenas.','fecha_movimiento'=>'2026-06-07 18:40:00'],
            ['id'=>11,'producto_id'=>6,'tipo_movimiento_id'=>29,'cantidad'=>25,'motivo'=>'Ingreso de coronas Bajaj.','fecha_movimiento'=>'2026-06-01 08:50:00'],
            ['id'=>12,'producto_id'=>6,'tipo_movimiento_id'=>30,'cantidad'=>5,'motivo'=>'Ventas de transmision.','fecha_movimiento'=>'2026-06-07 18:50:00'],
            ['id'=>13,'producto_id'=>7,'tipo_movimiento_id'=>29,'cantidad'=>15,'motivo'=>'Ingreso de llantas tubeless.','fecha_movimiento'=>'2026-06-01 09:00:00'],
            ['id'=>14,'producto_id'=>7,'tipo_movimiento_id'=>30,'cantidad'=>3,'motivo'=>'Ventas de llantas.','fecha_movimiento'=>'2026-06-07 19:00:00'],
            ['id'=>15,'producto_id'=>8,'tipo_movimiento_id'=>29,'cantidad'=>18,'motivo'=>'Ingreso de amortiguadores.','fecha_movimiento'=>'2026-06-01 09:10:00'],
            ['id'=>16,'producto_id'=>8,'tipo_movimiento_id'=>30,'cantidad'=>3,'motivo'=>'Venta de amortiguadores.','fecha_movimiento'=>'2026-06-07 19:10:00'],
            ['id'=>17,'producto_id'=>9,'tipo_movimiento_id'=>29,'cantidad'=>25,'motivo'=>'Ingreso de faros LED.','fecha_movimiento'=>'2026-06-01 09:20:00'],
            ['id'=>18,'producto_id'=>9,'tipo_movimiento_id'=>30,'cantidad'=>3,'motivo'=>'Venta de faros LED.','fecha_movimiento'=>'2026-06-07 19:20:00'],
            ['id'=>19,'producto_id'=>10,'tipo_movimiento_id'=>29,'cantidad'=>12,'motivo'=>'Ingreso de cascos integrales.','fecha_movimiento'=>'2026-06-01 09:30:00'],
            ['id'=>20,'producto_id'=>10,'tipo_movimiento_id'=>30,'cantidad'=>2,'motivo'=>'Venta de cascos.','fecha_movimiento'=>'2026-06-07 19:30:00'],
        ]);
    }
}