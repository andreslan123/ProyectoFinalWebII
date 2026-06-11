<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarritoSeeder extends Seeder
{
    public function run()
    {
        DB::table('carritos')->insert([
            ['id'=>1,'user_id'=>2,'estado_id'=>34,'created_at'=>'2026-06-09 09:00:00'],
            ['id'=>2,'user_id'=>3,'estado_id'=>34,'created_at'=>'2026-06-09 09:05:00'],
            ['id'=>3,'user_id'=>4,'estado_id'=>35,'created_at'=>'2026-06-09 09:10:00'],
            ['id'=>4,'user_id'=>5,'estado_id'=>34,'created_at'=>'2026-06-09 09:15:00'],
            ['id'=>5,'user_id'=>6,'estado_id'=>36,'created_at'=>'2026-06-09 09:20:00'],
            ['id'=>6,'user_id'=>7,'estado_id'=>34,'created_at'=>'2026-06-09 09:25:00'],
            ['id'=>7,'user_id'=>8,'estado_id'=>35,'created_at'=>'2026-06-09 09:30:00'],
            ['id'=>8,'user_id'=>9,'estado_id'=>34,'created_at'=>'2026-06-09 09:35:00'],
            ['id'=>9,'user_id'=>10,'estado_id'=>36,'created_at'=>'2026-06-09 09:40:00'],
            ['id'=>10,'user_id'=>2,'estado_id'=>34,'created_at'=>'2026-06-09 09:45:00'],
        ]);
    }
}