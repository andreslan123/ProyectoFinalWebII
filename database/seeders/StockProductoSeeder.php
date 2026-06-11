<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockProductoSeeder extends Seeder
{
    public function run()
    {
        DB::table('stock_productos')->insert([
            ['id'=>1,'producto_id'=>1,'cantidad_actual'=>40,'stock_minimo'=>10],
            ['id'=>2,'producto_id'=>2,'cantidad_actual'=>35,'stock_minimo'=>8],
            ['id'=>3,'producto_id'=>3,'cantidad_actual'=>25,'stock_minimo'=>6],
            ['id'=>4,'producto_id'=>4,'cantidad_actual'=>60,'stock_minimo'=>10],
            ['id'=>5,'producto_id'=>5,'cantidad_actual'=>18,'stock_minimo'=>5],
            ['id'=>6,'producto_id'=>6,'cantidad_actual'=>20,'stock_minimo'=>5],
            ['id'=>7,'producto_id'=>7,'cantidad_actual'=>12,'stock_minimo'=>4],
            ['id'=>8,'producto_id'=>8,'cantidad_actual'=>15,'stock_minimo'=>4],
            ['id'=>9,'producto_id'=>9,'cantidad_actual'=>22,'stock_minimo'=>5],
            ['id'=>10,'producto_id'=>10,'cantidad_actual'=>10,'stock_minimo'=>3],
        ]);
    }
}