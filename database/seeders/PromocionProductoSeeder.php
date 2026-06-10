<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromocionProductoSeeder extends Seeder
{
    public function run()
    {
        DB::table('promocion_productos')->insert([

            [
                'promocion_id'=>1,
                'producto_id'=>3
            ],

            [
                'promocion_id'=>1,
                'producto_id'=>4
            ],

            [
                'promocion_id'=>2,
                'producto_id'=>1
            ],

            [
                'promocion_id'=>2,
                'producto_id'=>2
            ],

            [
                'promocion_id'=>3,
                'producto_id'=>8
            ]

        ]);
    }
}