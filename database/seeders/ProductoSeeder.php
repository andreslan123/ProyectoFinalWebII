<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        for($i=1; $i<=10; $i++)
        {
            DB::table('productos')->insert([
                'subcategoria_id' => rand(1,10),
                'marca_id' => rand(1,10),
                'estado_id' => 1,
                'codigo' => 'PROD'.$i,
                'nombre' => 'Producto '.$i,
                'descripcion' => 'Descripcion del producto '.$i,
                'precio_compra' => rand(100,500),
                'precio_venta' => rand(600,1500)
            ]);
        }
    }
}