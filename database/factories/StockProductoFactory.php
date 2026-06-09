<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StockProducto;
use App\Models\Producto;

class StockProductoFactory extends Factory
{
    protected $model=StockProducto::class;
    public function definition()
    {
        return [
            'producto_id' => Producto::inRandomOrder()->first()->id ?? Producto::factory(),
            'cantidad_actual' => $this->faker->numberBetween(10, 100), // Stock inicial aleatorio
            'stock_minimo' => 5,
            'stock_maximo' => 150,
        ];
    }
}
