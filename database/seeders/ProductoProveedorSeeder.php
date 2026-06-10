<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoProveedorSeeder extends Seeder
{
    public function run()
    {
        DB::table('producto_proveedor')->insert([

            ['producto_id'=>1,'proveedor_id'=>1],
            ['producto_id'=>2,'proveedor_id'=>2],
            ['producto_id'=>3,'proveedor_id'=>3],
            ['producto_id'=>4,'proveedor_id'=>4],
            ['producto_id'=>5,'proveedor_id'=>5],
            ['producto_id'=>6,'proveedor_id'=>6],
            ['producto_id'=>7,'proveedor_id'=>7],
            ['producto_id'=>8,'proveedor_id'=>8],
            ['producto_id'=>9,'proveedor_id'=>9],
            ['producto_id'=>10,'proveedor_id'=>10]

        ]);
    }
}