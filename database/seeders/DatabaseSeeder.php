<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;       
use App\Models\Producto;   

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolSeeder::class,
            CategoriaSeeder::class,
            MarcaSeeder::class,
            SubcategoriaSeeder::class,
            ProveedorSeeder::class,
        ]);

        User::factory(10)->create();    
        Producto::factory(50)->create(); 
    }
}