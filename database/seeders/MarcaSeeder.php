<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    public function run()
    {
        DB::table('marcas')->insert([
            ['nombre'=>'Toyota'],
            ['nombre'=>'Honda'],
            ['nombre'=>'Nissan'],
            ['nombre'=>'Chevrolet'],
            ['nombre'=>'Ford'],
            ['nombre'=>'Hyundai'],
            ['nombre'=>'Kia'],
            ['nombre'=>'Mazda'],
            ['nombre'=>'Volkswagen'],
            ['nombre'=>'Suzuki']
        ]);
    }
}