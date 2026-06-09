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
                'nombre_empresa'=>'Tech Bolivia',
                'nit'=>'100001',
                'correo'=>'tech1@gmail.com',
                'direccion'=>'La Paz'
            ],
            [
                'estado_id'=>1,
                'nombre_empresa'=>'Digital Store',
                'nit'=>'100002',
                'correo'=>'tech2@gmail.com',
                'direccion'=>'Santa Cruz'
            ],
            [
                'estado_id'=>1,
                'nombre_empresa'=>'CompuCenter',
                'nit'=>'100003',
                'correo'=>'tech3@gmail.com',
                'direccion'=>'Cochabamba'
            ],
            [
                'estado_id'=>1,
                'nombre_empresa'=>'MegaPC',
                'nit'=>'100004',
                'correo'=>'tech4@gmail.com',
                'direccion'=>'Oruro'
            ],
            [
                'estado_id'=>1,
                'nombre_empresa'=>'ElectroNet',
                'nit'=>'100005',
                'correo'=>'tech5@gmail.com',
                'direccion'=>'Tarija'
            ],
            [
                'estado_id'=>1,
                'nombre_empresa'=>'InfoWorld',
                'nit'=>'100006',
                'correo'=>'tech6@gmail.com',
                'direccion'=>'Beni'
            ],
            [
                'estado_id'=>1,
                'nombre_empresa'=>'Smart Import',
                'nit'=>'100007',
                'correo'=>'tech7@gmail.com',
                'direccion'=>'Pando'
            ],
            [
                'estado_id'=>1,
                'nombre_empresa'=>'Digital Plus',
                'nit'=>'100008',
                'correo'=>'tech8@gmail.com',
                'direccion'=>'La Paz'
            ],
            [
                'estado_id'=>1,
                'nombre_empresa'=>'Tech Global',
                'nit'=>'100009',
                'correo'=>'tech9@gmail.com',
                'direccion'=>'Santa Cruz'
            ],
            [
                'estado_id'=>1,
                'nombre_empresa'=>'Importadora Uno',
                'nit'=>'100010',
                'correo'=>'tech10@gmail.com',
                'direccion'=>'Cochabamba'
            ]
        ]);
    }
}