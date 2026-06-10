<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelefonoUsuarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('telefonos_usuarios')->insert([

            [
                'user_id'=>1,
                'tipo_telefono_id'=>1,
                'numero'=>'70111111'
            ],

            [
                'user_id'=>2,
                'tipo_telefono_id'=>1,
                'numero'=>'70222222'
            ],

            [
                'user_id'=>3,
                'tipo_telefono_id'=>1,
                'numero'=>'70333333'
            ],

            [
                'user_id'=>4,
                'tipo_telefono_id'=>1,
                'numero'=>'70444444'
            ],

            [
                'user_id'=>5,
                'tipo_telefono_id'=>1,
                'numero'=>'70555555'
            ]

        ]);
    }
}