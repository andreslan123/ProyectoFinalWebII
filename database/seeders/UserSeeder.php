<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([

            [
                'rol_id' => 1,
                'estado_id' => 1,
                'name' => 'Administrador',
                'apellido_paterno' => 'Racing',
                'apellido_materno' => 'Diez',
                'ci' => '10000001',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678')
            ],

            [
                'rol_id' => 3,
                'estado_id' => 1,
                'name' => 'Vendedor',
                'apellido_paterno' => 'Principal',
                'apellido_materno' => 'Racing',
                'ci' => '10000002',
                'email' => 'vendedor@gmail.com',
                'password' => Hash::make('12345678')
            ],

            [
                'rol_id' => 2,
                'estado_id' => 1,
                'name' => 'Carlos',
                'apellido_paterno' => 'Perez',
                'apellido_materno' => 'Mendoza',
                'ci' => '10000003',
                'email' => 'carlos@gmail.com',
                'password' => Hash::make('12345678')
            ],

            [
                'rol_id' => 2,
                'estado_id' => 1,
                'name' => 'Juan',
                'apellido_paterno' => 'Flores',
                'apellido_materno' => 'Quispe',
                'ci' => '10000004',
                'email' => 'juan@gmail.com',
                'password' => Hash::make('12345678')
            ],

            [
                'rol_id' => 2,
                'estado_id' => 1,
                'name' => 'Maria',
                'apellido_paterno' => 'Lopez',
                'apellido_materno' => 'Vargas',
                'ci' => '10000005',
                'email' => 'maria@gmail.com',
                'password' => Hash::make('12345678')
            ]

        ]);
    }
}