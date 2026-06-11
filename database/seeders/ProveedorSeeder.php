<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        DB::table('proveedores')->insert([
            ['id'=>1, 'estado_id'=>7, 'nombre_empresa'=>'Importadora MotoParts Bolivia', 'nit'=>'100001', 'correo'=>'ventas@motopartsbolivia.com', 'direccion'=>'Av. Buenos Aires #120, La Paz'],
            ['id'=>2, 'estado_id'=>7, 'nombre_empresa'=>'Repuestos Racing10 SRL', 'nit'=>'100002', 'correo'=>'contacto@racing10.com', 'direccion'=>'Av. Blanco Galindo Km 4, Cochabamba'],
            ['id'=>3, 'estado_id'=>7, 'nombre_empresa'=>'Distribuidora Honda Sur', 'nit'=>'100003', 'correo'=>'hondasur@gmail.com', 'direccion'=>'Av. Santos Dumont #450, Santa Cruz'],
            ['id'=>4, 'estado_id'=>7, 'nombre_empresa'=>'Lubricantes Max Moto', 'nit'=>'100004', 'correo'=>'lubrimax@gmail.com', 'direccion'=>'Zona Central #88, Oruro'],
            ['id'=>5, 'estado_id'=>7, 'nombre_empresa'=>'Frenos y Pastillas Pro', 'nit'=>'100005', 'correo'=>'frenospro@gmail.com', 'direccion'=>'Mercado Campesino #25, Sucre'],
            ['id'=>6, 'estado_id'=>7, 'nombre_empresa'=>'Transmision Moto Center', 'nit'=>'100006', 'correo'=>'transmisioncenter@gmail.com', 'direccion'=>'Av. Circunvalacion #340, Tarija'],
            ['id'=>7, 'estado_id'=>7, 'nombre_empresa'=>'Neumaticos del Oriente', 'nit'=>'100007', 'correo'=>'neumaticosoriente@gmail.com', 'direccion'=>'3er Anillo Interno #770, Santa Cruz'],
            ['id'=>8, 'estado_id'=>7, 'nombre_empresa'=>'Electric Moto Bolivia', 'nit'=>'100008', 'correo'=>'electricmoto@gmail.com', 'direccion'=>'Calle Comercio #45, La Paz'],
            ['id'=>9, 'estado_id'=>7, 'nombre_empresa'=>'Accesorios Rider Store', 'nit'=>'100009', 'correo'=>'riderstore@gmail.com', 'direccion'=>'Av. Aroma #210, Cochabamba'],
            ['id'=>10,'estado_id'=>7, 'nombre_empresa'=>'Cascos y Seguridad Total','nit'=>'100010','correo'=>'seguridadtotal@gmail.com','direccion'=>'Av. Panamericana #15, Potosi'],
        ]);
    }
}