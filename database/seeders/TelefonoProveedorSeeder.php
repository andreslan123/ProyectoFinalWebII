<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelefonoProveedorSeeder extends Seeder
{
    public function run()
    {
        DB::table('telefonos_proveedores')->insert([
            ['id' => 1, 'proveedor_id' => 1, 'tipo_telefono_id' => 1, 'numero' => '72000001', 'estado_id' => 7],
            ['id' => 2, 'proveedor_id' => 2, 'tipo_telefono_id' => 1, 'numero' => '72000002', 'estado_id' => 7],
            ['id' => 3, 'proveedor_id' => 3, 'tipo_telefono_id' => 3, 'numero' => '72000003', 'estado_id' => 7],
            ['id' => 4, 'proveedor_id' => 4, 'tipo_telefono_id' => 1, 'numero' => '72000004', 'estado_id' => 7],
            ['id' => 5, 'proveedor_id' => 5, 'tipo_telefono_id' => 3, 'numero' => '72000005', 'estado_id' => 7],
            ['id' => 6, 'proveedor_id' => 6, 'tipo_telefono_id' => 1, 'numero' => '72000006', 'estado_id' => 7],
            ['id' => 7, 'proveedor_id' => 7, 'tipo_telefono_id' => 1, 'numero' => '72000007', 'estado_id' => 7],
            ['id' => 8, 'proveedor_id' => 8, 'tipo_telefono_id' => 3, 'numero' => '72000008', 'estado_id' => 7],
            ['id' => 9, 'proveedor_id' => 9, 'tipo_telefono_id' => 2, 'numero' => '4402009', 'estado_id' => 7],
            ['id' => 10, 'proveedor_id' => 10, 'tipo_telefono_id' => 1, 'numero' => '72000010', 'estado_id' => 7],
        ]);
    }
}