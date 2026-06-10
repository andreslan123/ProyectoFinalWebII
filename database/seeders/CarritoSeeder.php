<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarritoSeeder extends Seeder
{
    public function run()
    {
        DB::table('carritos')->insert([

            [
                'user_id' => 1,
                'estado_id' => 1
            ],

            [
                'user_id' => 2,
                'estado_id' => 1
            ],

            [
                'user_id' => 3,
                'estado_id' => 1
            ]

        ]);
    }
}