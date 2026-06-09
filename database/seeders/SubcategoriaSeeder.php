<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('subcategorias')->insert([
            ['categoria_id'=>1,'nombre'=>'Gaming'],
            ['categoria_id'=>1,'nombre'=>'Ultrabook'],
            ['categoria_id'=>2,'nombre'=>'Android'],
            ['categoria_id'=>2,'nombre'=>'iPhone'],
            ['categoria_id'=>3,'nombre'=>'4K'],
            ['categoria_id'=>3,'nombre'=>'Curvos'],
            ['categoria_id'=>4,'nombre'=>'Teclados'],
            ['categoria_id'=>4,'nombre'=>'Mouse'],
            ['categoria_id'=>5,'nombre'=>'Laser'],
            ['categoria_id'=>6,'nombre'=>'Android Tablet']
        ]);
    }
}