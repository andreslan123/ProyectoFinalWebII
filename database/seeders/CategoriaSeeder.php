<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Laptops'],
            ['nombre' => 'Celulares'],
            ['nombre' => 'Monitores'],
            ['nombre' => 'Accesorios'],
            ['nombre' => 'Impresoras'],
            ['nombre' => 'Tablets'],
            ['nombre' => 'Audifonos'],
            ['nombre' => 'Teclados'],
            ['nombre' => 'Mouse'],
            ['nombre' => 'Camaras']
        ]);
    }
}