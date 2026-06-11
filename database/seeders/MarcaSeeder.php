<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    public function run()
    {
        DB::table('marcas')->insert([
            ['id' => 1, 'nombre' => 'Honda'],
            ['id' => 2, 'nombre' => 'Yamaha'],
            ['id' => 3, 'nombre' => 'Suzuki'],
            ['id' => 4, 'nombre' => 'Kawasaki'],
            ['id' => 5, 'nombre' => 'Bajaj'],
            ['id' => 6, 'nombre' => 'KTM'],
            ['id' => 7, 'nombre' => 'TVS'],
            ['id' => 8, 'nombre' => 'Italika'],
            ['id' => 9, 'nombre' => 'Loncin'],
            ['id' => 10, 'nombre' => 'NGK'],
        ]);
    }
}