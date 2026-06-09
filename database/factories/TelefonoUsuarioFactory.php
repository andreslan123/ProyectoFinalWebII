<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Catalogo;
use App\Models\TelefonoUsuario;

class TelefonoUsuarioFactory extends Factory
{
    protected $model = TelefonoUsuario::class;
    public function definition()
    {
        return [
            // Elige un ID de un usuario aleatorio que ya exista en la base de datos
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            
            // Faker genera un número de teléfono realista (ej: 71234567 o similar)
            'numero' => $this->faker->numerify('########'), 
            
            // Llaves foráneas a tus tablas de configuración/catálogos fijos
            'tipo_telefono_id' => $this->faker->numberBetween(1, 3), // Celular, Fijo, Trabajo
            'estado_id' => 1, // El ID del catálogo para "Activo"
        ];
    }
}
