<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoImagenSeeder extends Seeder
{
    public function run()
    {
        DB::table('producto_imagenes')->insert([
            ['id'=>1,'producto_id'=>1,'imagen'=>'imagenes/productos/aceite-honda-20w50.jpg','estado_id'=>4],
            ['id'=>2,'producto_id'=>2,'imagen'=>'imagenes/productos/filtro-aceite-honda-cg.jpg','estado_id'=>4],
            ['id'=>3,'producto_id'=>3,'imagen'=>'imagenes/productos/pastillas-freno-yamaha-fz.jpg','estado_id'=>4],
            ['id'=>4,'producto_id'=>4,'imagen'=>'imagenes/productos/bujia-ngk-iridium.jpg','estado_id'=>4],
            ['id'=>5,'producto_id'=>5,'imagen'=>'imagenes/productos/cadena-reforzada-428h.jpg','estado_id'=>4],
            ['id'=>6,'producto_id'=>6,'imagen'=>'imagenes/productos/corona-bajaj-pulsar.jpg','estado_id'=>4],
            ['id'=>7,'producto_id'=>7,'imagen'=>'imagenes/productos/llanta-tubeless-9090-18.jpg','estado_id'=>4],
            ['id'=>8,'producto_id'=>8,'imagen'=>'imagenes/productos/amortiguador-trasero.jpg','estado_id'=>4],
            ['id'=>9,'producto_id'=>9,'imagen'=>'imagenes/productos/faro-led-auxiliar.jpg','estado_id'=>4],
            ['id'=>10,'producto_id'=>10,'imagen'=>'imagenes/productos/casco-integral-racing.jpg','estado_id'=>4],
        ]);
    }
}