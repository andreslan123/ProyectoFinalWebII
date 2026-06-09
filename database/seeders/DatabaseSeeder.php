<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;       // 👈 ¡No olvides importar tu modelo User aquí arriba!
use App\Models\Producto;   // 👈 ¡Importa también tu modelo Producto!

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Primero se ejecutan las tablas con datos fijos de tu compañero
        $this->call([
            RolSeeder::class,
            CategoriaSeeder::class,
            MarcaSeeder::class,
            SubcategoriaSeeder::class,
            ProveedorSeeder::class,
            // Quitamos ProductoSeeder de aquí porque ahora lo hará tu Factory 👇
        ]);

        // 2. ¡Aquí das la orden para que los factories creen los datos masivos!
        User::factory(10)->create();     // Fabrica 10 usuarios aleatorios en la base de datos
        Producto::factory(50)->create(); // Fabrica 50 productos aleatorios con Faker
    }
}