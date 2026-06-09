<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Roles
        DB::table('roles')->insert([
            ['nombre' => 'Administrador'],
            ['nombre' => 'Cliente']
        ]);

        // Categorías
        DB::table('categorias')->insert([
            ['nombre' => 'Laptops'],
            ['nombre' => 'Celulares'],
            ['nombre' => 'Accesorios'],
            ['nombre' => 'Monitores']
        ]);

        // Usuario administrador
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        // Proveedores
        DB::table('proveedores')->insert([
            [
                'estado_id' => 1,
                'nombre_empresa' => 'Tech Bolivia',
                'nit' => '1234567',
                'correo' => 'ventas@tech.com',
                'direccion' => 'La Paz'
            ],
            [
                'estado_id' => 1,
                'nombre_empresa' => 'Importadora Digital',
                'nit' => '7654321',
                'correo' => 'info@digital.com',
                'direccion' => 'Santa Cruz'
            ]
        ]);

        // Promociones
        DB::table('promociones')->insert([
            [
                'estado_id' => 1,
                'tipo_descuento' => 'PORCENTAJE',
                'titulo' => 'Oferta de Bienvenida',
                'descripcion' => 'Descuento para nuevos clientes',
                'valor_descuento' => 10,
                'fecha_inicio' => now(),
                'fecha_fin' => now()->addDays(30)
            ]
        ]);
    }
}