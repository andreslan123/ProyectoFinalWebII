<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resena;
use App\Models\Producto;
use App\Models\User;
class ResenaFactory extends Factory
{
    protected $model=Resena::class;
    public function definition()
    {
        return [
            'producto_id' => Producto::inRandomOrder()->first()->id ?? Producto::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            
            // Calificación típica de e-commerce (1 a 5 estrellas)
            'calificacion' => $this->faker->numberBetween(1, 5), 
            
            'comentario' => $this->faker->randomElement([
                'Excelente producto, llegó súper rápido y tal como en la foto.',
                'Cumple con lo que promete, aunque el empaque llegó un poco arrugado.',
                'Muy buena calidad de materiales, lo recomiendo totalmente.',
                'No era lo que esperaba, el tamaño es más pequeño de lo que dice la descripción.',
                'Relación calidad-precio insuperable. Volveré a comprar.'
            ]),
            'estado_id' => 1, // ID del catálogo para 'Aprobado/Visible
        ];
    }
}
