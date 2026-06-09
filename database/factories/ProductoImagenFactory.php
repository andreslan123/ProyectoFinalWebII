<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;
use App\Models\ProductoImagen;

class ProductoImagenFactory extends Factory
{
    protected $model= ProductoImagen::class;
    public function definition()
    {
        return [
            // Vincula la imagen a un producto aleatorio de los que ya existan
            'producto_id' => Producto::inRandomOrder()->first()->id ?? Producto::factory(),
            'url_imagen' => $this->faker->imageUrl(640, 480, 'tech', true), // URL simulada de una foto tecnológica
            'estado_id' => 1,
        ];
    }
}
