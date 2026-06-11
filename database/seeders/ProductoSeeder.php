<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        DB::table('productos')->insert([
            ['id'=>1, 'subcategoria_id'=>1, 'marca_id'=>1, 'estado_id'=>4, 'codigo'=>'MOT001', 'nombre'=>'Aceite Honda 20W50 1L', 'descripcion'=>'Aceite mineral para motocicleta de uso diario.', 'precio_compra'=>55.00, 'precio_venta'=>80.00],
            ['id'=>2, 'subcategoria_id'=>2, 'marca_id'=>1, 'estado_id'=>4, 'codigo'=>'MOT002', 'nombre'=>'Filtro de Aceite Honda CG', 'descripcion'=>'Filtro compatible con motores Honda CG y modelos similares.', 'precio_compra'=>18.00, 'precio_venta'=>35.00],
            ['id'=>3, 'subcategoria_id'=>3, 'marca_id'=>2, 'estado_id'=>4, 'codigo'=>'MOT003', 'nombre'=>'Pastillas de Freno Yamaha FZ', 'descripcion'=>'Juego de pastillas delanteras de alto rendimiento.', 'precio_compra'=>45.00, 'precio_venta'=>75.00],
            ['id'=>4, 'subcategoria_id'=>4, 'marca_id'=>10, 'estado_id'=>4, 'codigo'=>'MOT004', 'nombre'=>'Bujia NGK Iridium CR8EIX', 'descripcion'=>'Bujia iridium para mejor encendido y respuesta.', 'precio_compra'=>35.00, 'precio_venta'=>60.00],
            ['id'=>5, 'subcategoria_id'=>5, 'marca_id'=>3, 'estado_id'=>4, 'codigo'=>'MOT005', 'nombre'=>'Cadena Reforzada 428H', 'descripcion'=>'Cadena reforzada para motocicletas urbanas y deportivas.', 'precio_compra'=>80.00, 'precio_venta'=>130.00],
            ['id'=>6, 'subcategoria_id'=>6, 'marca_id'=>5, 'estado_id'=>4, 'codigo'=>'MOT006', 'nombre'=>'Corona Bajaj Pulsar 43T', 'descripcion'=>'Corona trasera compatible con Bajaj Pulsar.', 'precio_compra'=>65.00, 'precio_venta'=>110.00],
            ['id'=>7, 'subcategoria_id'=>7, 'marca_id'=>4, 'estado_id'=>4, 'codigo'=>'MOT007', 'nombre'=>'Llanta Tubeless 90/90-18', 'descripcion'=>'Llanta para uso urbano con buena adherencia.', 'precio_compra'=>180.00, 'precio_venta'=>260.00],
            ['id'=>8, 'subcategoria_id'=>8, 'marca_id'=>7, 'estado_id'=>4, 'codigo'=>'MOT008', 'nombre'=>'Amortiguador Trasero Universal', 'descripcion'=>'Amortiguador reforzado para motocicletas medianas.', 'precio_compra'=>170.00, 'precio_venta'=>250.00],
            ['id'=>9, 'subcategoria_id'=>9, 'marca_id'=>8, 'estado_id'=>4, 'codigo'=>'MOT009', 'nombre'=>'Faro LED Auxiliar 12V', 'descripcion'=>'Faro LED auxiliar para mayor visibilidad nocturna.', 'precio_compra'=>90.00, 'precio_venta'=>150.00],
            ['id'=>10,'subcategoria_id'=>10,'marca_id'=>6,'estado_id'=>4,'codigo'=>'MOT010','nombre'=>'Casco Integral Racing Negro','descripcion'=>'Casco integral con diseño deportivo y visor transparente.','precio_compra'=>260.00,'precio_venta'=>390.00],
        ]);
    }
}