<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromocionSeeder extends Seeder
{
    public function run()
    {
        DB::table('promociones')->insert([

            [
                'estado_id' => 1,
                'tipo_descuento' => 'PORCENTAJE',
                'titulo' => 'Promo Frenos',
                'descripcion' => 'Descuento especial en frenos',
                'valor_descuento' => 10,
                'fecha_inicio' => '2026-06-01',
                'fecha_fin' => '2026-06-30'
            ],

            [
                'estado_id' => 1,
                'tipo_descuento' => 'PORCENTAJE',
                'titulo' => 'Promo Motores',
                'descripcion' => 'Descuento especial en motores',
                'valor_descuento' => 15,
                'fecha_inicio' => '2026-06-01',
                'fecha_fin' => '2026-07-15'
            ],

            [
                'estado_id' => 1,
                'tipo_descuento' => 'PORCENTAJE',
                'titulo' => 'Promo Baterias',
                'descripcion' => 'Descuento especial en baterias',
                'valor_descuento' => 20,
                'fecha_inicio' => '2026-06-05',
                'fecha_fin' => '2026-06-25'
            ]

        ]);
    }
}