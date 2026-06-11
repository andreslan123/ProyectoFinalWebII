<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarritoDetalleSeeder extends Seeder
{
    public function run()
    {
        DB::table('carrito_detalles')->insert([
            ['id'=>1,'carrito_id'=>1,'producto_id'=>1,'cantidad'=>1],
            ['id'=>2,'carrito_id'=>2,'producto_id'=>3,'cantidad'=>2],
            ['id'=>3,'carrito_id'=>3,'producto_id'=>5,'cantidad'=>1],
            ['id'=>4,'carrito_id'=>4,'producto_id'=>8,'cantidad'=>1],
            ['id'=>5,'carrito_id'=>5,'producto_id'=>10,'cantidad'=>3],
            ['id'=>6,'carrito_id'=>6,'producto_id'=>2,'cantidad'=>1],
            ['id'=>7,'carrito_id'=>7,'producto_id'=>7,'cantidad'=>2],
            ['id'=>8,'carrito_id'=>8,'producto_id'=>4,'cantidad'=>1],
            ['id'=>9,'carrito_id'=>9,'producto_id'=>9,'cantidad'=>1],
            ['id'=>10,'carrito_id'=>10,'producto_id'=>6,'cantidad'=>1],
        ]);
    }
}