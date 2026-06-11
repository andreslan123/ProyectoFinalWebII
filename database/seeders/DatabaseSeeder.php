<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolSeeder::class,
            EstadoGeneralSeeder::class,

            CategoriaSeeder::class,
            MarcaSeeder::class,
            SubcategoriaSeeder::class,

            UserSeeder::class,
            ProveedorSeeder::class,

            TipoTelefonoSeeder::class,
            TelefonoUsuarioSeeder::class,
            TelefonoProveedorSeeder::class,

            ProductoSeeder::class,
            StockProductoSeeder::class,
            ProductoProveedorSeeder::class,
            ProductoImagenSeeder::class,

            PromocionSeeder::class,
            PromocionProductoSeeder::class,

            CarritoSeeder::class,
            CarritoDetalleSeeder::class,

            PedidoSeeder::class,
            PedidoDetalleSeeder::class,

            PagoSeeder::class,
            EnvioSeeder::class,

            MovimientoStockSeeder::class,
            ResenaSeeder::class,
        ]);
    }
}