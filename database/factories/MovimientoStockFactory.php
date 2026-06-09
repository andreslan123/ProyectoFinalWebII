<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MovimientoStock;
use App\Models\Producto;
use App\Models\User;
class MovimientoStockFactory extends Factory
{
    protected $model= MovimientoStock::class;
    public function definition()
    {
        return [
            'producto_id' => Producto::inRandomOrder()->first()->id ?? Producto::factory(),
            
            // Simula si es una Entrada (sumar stock) o Salida (restar stock) usando texto o IDs de tus catálogos
            'tipo_movimiento' => $this->faker->randomElement(['INGRESO', 'EGRESO']), 
            
            'cantidad' => $this->faker->numberBetween(1, 20),
            'descripcion' => $this->faker->randomElement([
                'Ingreso por reabastecimiento de proveedor',
                'Egreso automático por venta online',
                'Corrección manual de inventario'
            ]),
            
            // ID del usuario/empleado que registró el movimiento de almacén
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}
