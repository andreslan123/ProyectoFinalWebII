<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromocionProductoSeeder extends Seeder
{
    public function run()
    {
        DB::table('promocion_productos')->insert([
            ['id'=>1,'promocion_id'=>1,'producto_id'=>1],
            ['id'=>2,'promocion_id'=>2,'producto_id'=>3],
            ['id'=>3,'promocion_id'=>3,'producto_id'=>10],
            ['id'=>4,'promocion_id'=>4,'producto_id'=>5],
            ['id'=>5,'promocion_id'=>5,'producto_id'=>7],
            ['id'=>6,'promocion_id'=>6,'producto_id'=>9],
            ['id'=>7,'promocion_id'=>7,'producto_id'=>4],
            ['id'=>8,'promocion_id'=>8,'producto_id'=>2],
            ['id'=>9,'promocion_id'=>9,'producto_id'=>8],
            ['id'=>10,'promocion_id'=>10,'producto_id'=>6],
        ]);
    }
}