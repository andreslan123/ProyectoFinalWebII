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
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678')
            ],

            [
                'rol_id' => 3,
                'estado_id' => 1,
                'name' => 'Vendedor',
                'email' => 'vendedor@gmail.com',
                'password' => Hash::make('12345678')
            ],

            [
                'rol_id' => 2,
                'estado_id' => 1,
                'name' => 'Carlos Perez',
                'email' => 'carlos@gmail.com',
                'password' => Hash::make('12345678')
            ],

            [
                'rol_id' => 2,
                'estado_id' => 1,
                'name' => 'Juan Flores',
                'email' => 'juan@gmail.com',
                'password' => Hash::make('12345678')
            ],

            [
                'rol_id' => 2,
                'estado_id' => 1,
                'name' => 'Maria Lopez',
                'email' => 'maria@gmail.com',
                'password' => Hash::make('12345678')
            ]

        ]);
    }
}