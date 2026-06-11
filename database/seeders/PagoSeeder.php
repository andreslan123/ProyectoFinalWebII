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
                'id' => 1,
                'pedido_id' => 1,
                'metodo_pago' => 'QR',
                'monto' => 235.00,
                'referencia' => null,
                'fecha_pago' => '2026-06-01 10:15:00',
                'estado_id' => 16,
            ],
            [
                'id' => 2,
                'pedido_id' => 2,
                'metodo_pago' => 'Transferencia bancaria',
                'monto' => 250.00,
                'referencia' => null,
                'fecha_pago' => '2026-06-02 11:15:00',
                'estado_id' => 16,
            ],
            [
                'id' => 3,
                'pedido_id' => 3,
                'metodo_pago' => 'Efectivo contra entrega',
                'monto' => 260.00,
                'referencia' => null,
                'fecha_pago' => '2026-06-03 12:15:00',
                'estado_id' => 15,
            ],
            [
                'id' => 4,
                'pedido_id' => 4,
                'metodo_pago' => 'QR',
                'monto' => 460.00,
                'referencia' => null,
                'fecha_pago' => '2026-06-04 13:15:00',
                'estado_id' => 16,
            ],
            [
                'id' => 5,
                'pedido_id' => 5,
                'metodo_pago' => 'Transferencia bancaria',
                'monto' => 400.00,
                'referencia' => null,
                'fecha_pago' => '2026-06-05 14:15:00',
                'estado_id' => 15,
            ],
            [
                'id' => 6,
                'pedido_id' => 6,
                'metodo_pago' => 'QR',
                'monto' => 300.00,
                'referencia' => null,
                'fecha_pago' => '2026-06-06 15:15:00',
                'estado_id' => 16,
            ],
            [
                'id' => 7,
                'pedido_id' => 7,
                'metodo_pago' => 'Tarjeta',
                'monto' => 210.00,
                'referencia' => null,
                'fecha_pago' => '2026-06-07 16:15:00',
                'estado_id' => 16,
            ],
            [
                'id' => 8,
                'pedido_id' => 8,
                'metodo_pago' => 'QR',
                'monto' => 390.00,
                'referencia' => null,
                'fecha_pago' => '2026-06-08 17:15:00',
                'estado_id' => 16,
            ],
            [
                'id' => 9,
                'pedido_id' => 9,
                'metodo_pago' => 'Efectivo contra entrega',
                'monto' => 255.00,
                'referencia' => null,
                'fecha_pago' => '2026-06-09 18:15:00',
                'estado_id' => 15,
            ],
            [
                'id' => 10,
                'pedido_id' => 10,
                'metodo_pago' => 'Transferencia bancaria',
                'monto' => 500.00,
                'referencia' => null,
                'fecha_pago' => '2026-06-09 19:15:00',
                'estado_id' => 16,
            ],
        ]);
    }
}