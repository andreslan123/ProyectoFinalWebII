<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelefonoProveedorSeeder extends Seeder
{
    public function run()
    {
        DB::table('telefonos_proveedores')->insert([

            [
                'proveedor_id'=>1,
                'tipo_telefono_id'=>1,
                'numero'=>'72000001'
            ],

            [
                'proveedor_id'=>2,
                'tipo_telefono_id'=>1,
                'numero'=>'72000002'
            ],

            [
                'proveedor_id'=>3,
                'tipo_telefono_id'=>1,
                'numero'=>'72000003'
            ],

            [
                'proveedor_id'=>4,
                'tipo_telefono_id'=>1,
                'numero'=>'72000004'
            ],

            [
                'proveedor_id'=>5,
                'tipo_telefono_id'=>1,
                'numero'=>'72000005'
            ]

        ]);
    }
}