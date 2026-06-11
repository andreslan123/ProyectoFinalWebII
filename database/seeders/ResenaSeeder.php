<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResenaSeeder extends Seeder
{
    public function run()
    {
        DB::table('resenas')->insert([
            ['id'=>1,'user_id'=>2,'producto_id'=>1,'estado_id'=>27,'calificacion'=>5,'comentario'=>'Buen aceite, la moto trabaja más suave.','created_at'=>'2026-06-02 09:00:00'],
            ['id'=>2,'user_id'=>3,'producto_id'=>3,'estado_id'=>27,'calificacion'=>4,'comentario'=>'Las pastillas frenan bien y no hacen mucho ruido.','created_at'=>'2026-06-03 09:30:00'],
            ['id'=>3,'user_id'=>4,'producto_id'=>7,'estado_id'=>26,'calificacion'=>5,'comentario'=>'La llanta se ve resistente, falta probar en ruta.','created_at'=>'2026-06-04 10:00:00'],
            ['id'=>4,'user_id'=>5,'producto_id'=>10,'estado_id'=>27,'calificacion'=>5,'comentario'=>'El casco es cómodo y tiene buen diseño.','created_at'=>'2026-06-05 10:30:00'],
            ['id'=>5,'user_id'=>6,'producto_id'=>8,'estado_id'=>27,'calificacion'=>4,'comentario'=>'Buen amortiguador para uso urbano.','created_at'=>'2026-06-06 11:00:00'],
            ['id'=>6,'user_id'=>7,'producto_id'=>6,'estado_id'=>27,'calificacion'=>5,'comentario'=>'La corona encajó perfecto en mi Pulsar.','created_at'=>'2026-06-07 11:30:00'],
            ['id'=>7,'user_id'=>8,'producto_id'=>4,'estado_id'=>27,'calificacion'=>4,'comentario'=>'La bujía mejoró el arranque.','created_at'=>'2026-06-08 12:00:00'],
            ['id'=>8,'user_id'=>9,'producto_id'=>5,'estado_id'=>26,'calificacion'=>5,'comentario'=>'Cadena fuerte y buen precio.','created_at'=>'2026-06-09 12:30:00'],
            ['id'=>9,'user_id'=>10,'producto_id'=>9,'estado_id'=>27,'calificacion'=>4,'comentario'=>'El faro ilumina bastante bien de noche.','created_at'=>'2026-06-09 13:00:00'],
            ['id'=>10,'user_id'=>2,'producto_id'=>2,'estado_id'=>27,'calificacion'=>5,'comentario'=>'Filtro correcto para mantenimiento.','created_at'=>'2026-06-09 13:30:00'],
        ]);
    }
}