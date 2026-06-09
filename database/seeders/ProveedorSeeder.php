<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        DB::table('proveedores')->insert([

            [
                'estado_id'=>1,
                'nombre_empresa'=>'AutoPartes Bolivia',
                'nit'=>'100001',
                'correo'=>'contacto@autopartes.com',
                'direccion'=>'La Paz'
            ],

            [
                'estado_id'=>1,
                'nombre_empresa'=>'Motores Express',
                'nit'=>'100002',
                'correo'=>'ventas@motores.com',
                'direccion'=>'Santa Cruz'
            ],

            [
                'estado_id'=>1,
                'nombre_empresa'=>'Repuestos Toyota',
                'nit'=>'100003',
                'correo'=>'toyota@repuestos.com',
                'direccion'=>'Cochabamba'
            ],

            [
                'estado_id'=>1,
                'nombre_empresa'=>'Importadora Automotriz',
                'nit'=>'100004',
                'correo'=>'importadora@gmail.com',
                'direccion'=>'Oruro'
            ],

            [
                'estado_id'=>1,
                'nombre_empresa'=>'Frenos Center',
                'nit'=>'100005',
                'correo'=>'frenos@gmail.com',
                'direccion'=>'Tarija'
            ],

            [
                'estado_id'=>1,
                'nombre_empresa'=>'Suspension Pro',
                'nit'=>'100006',
                'correo'=>'suspension@gmail.com',
                'direccion'=>'Beni'
            ],

            [
                'estado_id'=>1,
                'nombre_empresa'=>'Lubricantes Max',
                'nit'=>'100007',
                'correo'=>'lubricantes@gmail.com',
                'direccion'=>'Pando'
            ],

            [
                'estado_id'=>1,
                'nombre_empresa'=>'Electric Auto',
                'nit'=>'100008',
                'correo'=>'electric@gmail.com',
                'direccion'=>'La Paz'
            ],

            [
                'estado_id'=>1,
                'nombre_empresa'=>'Faros y Accesorios',
                'nit'=>'100009',
                'correo'=>'faros@gmail.com',
                'direccion'=>'Santa Cruz'
            ],

            [
                'estado_id'=>1,
                'nombre_empresa'=>'Mega Repuestos',
                'nit'=>'100010',
                'correo'=>'mega@gmail.com',
                'direccion'=>'Cochabamba'
            ]

        ]);
    }
}