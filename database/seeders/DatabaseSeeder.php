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
            ProductoSeeder::class,

            UserSeeder::class,
            TipoTelefonoSeeder::class,
            TelefonoUsuarioSeeder::class,
            TelefonoProveedorSeeder::class,
            StockProductoSeeder::class,
            ProductoProveedorSeeder::class,
            PromocionSeeder::class,
            PromocionProductoSeeder::class,
            ProductoImagenSeeder::class,
            CarritoSeeder::class,
            CarritoDetalleSeeder::class,
            PedidoSeeder::class,
            PedidoDetalleSeeder::class,
            PagoSeeder::class,
            EnvioSeeder::class,
            MovimientoStockSeeder::class,
            ResenaSeeder::class,
        ]);
        //User::factory(10)->create();    
        //Producto::factory(50)->create(); 
    }
}