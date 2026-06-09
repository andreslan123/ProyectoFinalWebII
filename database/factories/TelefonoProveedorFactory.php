<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TelefonoProveedor;
use App\Models\Proveedor;
class TelefonoProveedorFactory extends Factory
{
    protected $model=TelefonoProveedor::class;
    public function definition()
    {
        return [
            'proveedor_id' => Proveedor::inRandomOrder()->first()->id ?? Proveedor::factory(),
            'numero' => $this->faker->numerify('########'), // Genera un número de 8 dígitos (Celulares en Bolivia)
            'tipo_telefono_id' => $this->faker->numberBetween(1, 3), // Celular, Fijo, Oficina
            'estado_id' => 1,
        ];
    }
}
