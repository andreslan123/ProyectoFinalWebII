<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelefonoUsuarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('telefonos_usuarios')->insert([
            ['id' => 1, 'user_id' => 1, 'tipo_telefono_id' => 1, 'numero' => '70100001', 'estado_id' => 1],
            ['id' => 2, 'user_id' => 2, 'tipo_telefono_id' => 1, 'numero' => '70100002', 'estado_id' => 1],
            ['id' => 3, 'user_id' => 3, 'tipo_telefono_id' => 3, 'numero' => '70100003', 'estado_id' => 1],
            ['id' => 4, 'user_id' => 4, 'tipo_telefono_id' => 1, 'numero' => '70100004', 'estado_id' => 1],
            ['id' => 5, 'user_id' => 5, 'tipo_telefono_id' => 3, 'numero' => '70100005', 'estado_id' => 1],
            ['id' => 6, 'user_id' => 6, 'tipo_telefono_id' => 1, 'numero' => '70100006', 'estado_id' => 1],
            ['id' => 7, 'user_id' => 7, 'tipo_telefono_id' => 3, 'numero' => '70100007', 'estado_id' => 1],
            ['id' => 8, 'user_id' => 8, 'tipo_telefono_id' => 1, 'numero' => '70100008', 'estado_id' => 1],
            ['id' => 9, 'user_id' => 9, 'tipo_telefono_id' => 2, 'numero' => '2401009', 'estado_id' => 1],
            ['id' => 10, 'user_id' => 10, 'tipo_telefono_id' => 1, 'numero' => '70100010', 'estado_id' => 1],
        ]);
    }
}