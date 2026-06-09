<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;
    public function definition()
    {
        return [
            'nombre' => $this->faker->words(3, true), // Ej: "Teclado Mecánico RGB"
            'descripcion' => $this->faker->sentence(15),
            'precio_venta' => $this->faker->randomFloat(2, 50, 2000), // Precios entre 50 y 2000 bs.
            'codigo_barra' => $this->faker->unique()->ean13(), // Código de 13 dígitos
            'marca_id' => $this->faker->numberBetween(1, 5), // Asumiendo que crearás 5 marcas en tu seeder
            'subcategoria_id' => $this->faker->numberBetween(1, 10), // Asumiendo 10 subcategorías
            'estado_id' => 4, // ID del catálogo para 'Disponible/Activo'
        ];
    }
}
