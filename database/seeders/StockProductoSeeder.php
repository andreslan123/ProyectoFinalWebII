<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockProductoSeeder extends Seeder
{
    public function run()
    {
        DB::table('stock_productos')->insert([

            [
                'producto_id' => 1,
                'cantidad_actual' => 50,
                'stock_minimo' => 10
            ],

            [
                'producto_id' => 2,
                'cantidad_actual' => 40,
                'stock_minimo' => 10
            ],

            [
                'producto_id' => 3,
                'cantidad_actual' => 35,
                'stock_minimo' => 10
            ],

            [
                'producto_id' => 4,
                'cantidad_actual' => 60,
                'stock_minimo' => 15
            ],

            [
                'producto_id' => 5,
                'cantidad_actual' => 25,
                'stock_minimo' => 5
            ]

        ]);
    }
}