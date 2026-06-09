<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        DB::table('productos')->insert([

            [
                'subcategoria_id'=>1,
                'marca_id'=>1,
                'estado_id'=>1,
                'codigo'=>'AUT001',
                'nombre'=>'Piston Toyota Corolla',
                'descripcion'=>'Piston original Toyota',
                'precio_compra'=>120,
                'precio_venta'=>180
            ],

            [
                'subcategoria_id'=>2,
                'marca_id'=>2,
                'estado_id'=>1,
                'codigo'=>'AUT002',
                'nombre'=>'Culata Honda Civic',
                'descripcion'=>'Culata completa Honda',
                'precio_compra'=>300,
                'precio_venta'=>450
            ],

            [
                'subcategoria_id'=>3,
                'marca_id'=>3,
                'estado_id'=>1,
                'codigo'=>'AUT003',
                'nombre'=>'Pastillas de Freno Nissan',
                'descripcion'=>'Juego completo',
                'precio_compra'=>50,
                'precio_venta'=>90
            ],

            [
                'subcategoria_id'=>4,
                'marca_id'=>4,
                'estado_id'=>1,
                'codigo'=>'AUT004',
                'nombre'=>'Disco de Freno Chevrolet',
                'descripcion'=>'Disco delantero',
                'precio_compra'=>80,
                'precio_venta'=>130
            ],

            [
                'subcategoria_id'=>5,
                'marca_id'=>5,
                'estado_id'=>1,
                'codigo'=>'AUT005',
                'nombre'=>'Amortiguador Ford',
                'descripcion'=>'Amortiguador trasero',
                'precio_compra'=>110,
                'precio_venta'=>170
            ],

            [
                'subcategoria_id'=>6,
                'marca_id'=>6,
                'estado_id'=>1,
                'codigo'=>'AUT006',
                'nombre'=>'Kit Embrague Hyundai',
                'descripcion'=>'Kit completo',
                'precio_compra'=>220,
                'precio_venta'=>320
            ],

            [
                'subcategoria_id'=>7,
                'marca_id'=>7,
                'estado_id'=>1,
                'codigo'=>'AUT007',
                'nombre'=>'Rotula Kia',
                'descripcion'=>'Rotula superior',
                'precio_compra'=>40,
                'precio_venta'=>75
            ],

            [
                'subcategoria_id'=>8,
                'marca_id'=>8,
                'estado_id'=>1,
                'codigo'=>'AUT008',
                'nombre'=>'Bateria Mazda',
                'descripcion'=>'Bateria 12V',
                'precio_compra'=>100,
                'precio_venta'=>160
            ],

            [
                'subcategoria_id'=>9,
                'marca_id'=>9,
                'estado_id'=>1,
                'codigo'=>'AUT009',
                'nombre'=>'Faro Volkswagen',
                'descripcion'=>'Faro delantero',
                'precio_compra'=>90,
                'precio_venta'=>145
            ],

            [
                'subcategoria_id'=>10,
                'marca_id'=>10,
                'estado_id'=>1,
                'codigo'=>'AUT010',
                'nombre'=>'Filtro Aceite Suzuki',
                'descripcion'=>'Filtro original',
                'precio_compra'=>20,
                'precio_venta'=>45
            ]

        ]);
    }
}