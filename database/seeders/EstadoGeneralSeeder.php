<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoGeneralSeeder extends Seeder
{
    public function run()
    {
        DB::table('estados_general')->insert([
            ['id' => 1, 'tipo' => 'estado_usuario', 'nombre' => 'activo'],
            ['id' => 2, 'tipo' => 'estado_usuario', 'nombre' => 'inactivo'],
            ['id' => 3, 'tipo' => 'estado_usuario', 'nombre' => 'suspendido'],

            ['id' => 4, 'tipo' => 'estado_producto', 'nombre' => 'activo'],
            ['id' => 5, 'tipo' => 'estado_producto', 'nombre' => 'inactivo'],
            ['id' => 6, 'tipo' => 'estado_producto', 'nombre' => 'agotado'],

            ['id' => 7, 'tipo' => 'estado_proveedor', 'nombre' => 'activo'],
            ['id' => 8, 'tipo' => 'estado_proveedor', 'nombre' => 'inactivo'],

            ['id' => 9, 'tipo' => 'estado_pedido', 'nombre' => 'pendiente'],
            ['id' => 10, 'tipo' => 'estado_pedido', 'nombre' => 'confirmado'],
            ['id' => 11, 'tipo' => 'estado_pedido', 'nombre' => 'en_proceso'],
            ['id' => 12, 'tipo' => 'estado_pedido', 'nombre' => 'enviado'],
            ['id' => 13, 'tipo' => 'estado_pedido', 'nombre' => 'entregado'],
            ['id' => 14, 'tipo' => 'estado_pedido', 'nombre' => 'cancelado'],

            ['id' => 15, 'tipo' => 'estado_pago', 'nombre' => 'pendiente'],
            ['id' => 16, 'tipo' => 'estado_pago', 'nombre' => 'aprobado'],
            ['id' => 17, 'tipo' => 'estado_pago', 'nombre' => 'rechazado'],
            ['id' => 18, 'tipo' => 'estado_pago', 'nombre' => 'reembolsado'],

            ['id' => 19, 'tipo' => 'estado_envio', 'nombre' => 'pendiente'],
            ['id' => 20, 'tipo' => 'estado_envio', 'nombre' => 'en_camino'],
            ['id' => 21, 'tipo' => 'estado_envio', 'nombre' => 'entregado'],
            ['id' => 22, 'tipo' => 'estado_envio', 'nombre' => 'fallido'],

            ['id' => 23, 'tipo' => 'estado_promocion', 'nombre' => 'activa'],
            ['id' => 24, 'tipo' => 'estado_promocion', 'nombre' => 'inactiva'],
            ['id' => 25, 'tipo' => 'estado_promocion', 'nombre' => 'vencida'],

            ['id' => 26, 'tipo' => 'estado_resena', 'nombre' => 'pendiente'],
            ['id' => 27, 'tipo' => 'estado_resena', 'nombre' => 'aprobada'],
            ['id' => 28, 'tipo' => 'estado_resena', 'nombre' => 'rechazada'],

            ['id' => 29, 'tipo' => 'tipo_movimiento_stock', 'nombre' => 'entrada'],
            ['id' => 30, 'tipo' => 'tipo_movimiento_stock', 'nombre' => 'salida'],
            ['id' => 31, 'tipo' => 'tipo_movimiento_stock', 'nombre' => 'ajuste'],

            ['id' => 32, 'tipo' => 'tipo_descuento', 'nombre' => 'porcentaje'],
            ['id' => 33, 'tipo' => 'tipo_descuento', 'nombre' => 'monto_fijo'],

            ['id' => 34, 'tipo' => 'estado_carrito', 'nombre' => 'activo'],
            ['id' => 35, 'tipo' => 'estado_carrito', 'nombre' => 'procesado'],
            ['id' => 36, 'tipo' => 'estado_carrito', 'nombre' => 'abandonado'],
        ]);
    }
}