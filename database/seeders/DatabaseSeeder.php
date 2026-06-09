<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            //RolSeeder::class,
            CategoriaSeeder::class,
            MarcaSeeder::class,
            SubcategoriaSeeder::class,
            ProveedorSeeder::class,
            ProductoSeeder::class,
        ]);
    }
}