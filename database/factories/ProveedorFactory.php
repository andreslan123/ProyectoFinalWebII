<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proveedor;

class ProveedorFactory extends Factory
{
    protected $model = Proveedor::class;
    public function definition()
    {
        
        return [
            'nombre' => $this->faker->company(),
            'nit' => $this->faker->unique()->numerify('#########'), // Genera un NIT de 9 dígitos
            'correo' => $this->faker->unique()->companyEmail(),
            'estado_id' => 1, // ID del catálogo para 'Activo'
        ];
    }
}
