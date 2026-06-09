<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    public function run()
    {
        DB::table('marcas')->insert([
            ['nombre'=>'HP'],
            ['nombre'=>'Dell'],
            ['nombre'=>'Lenovo'],
            ['nombre'=>'Asus'],
            ['nombre'=>'Acer'],
            ['nombre'=>'Samsung'],
            ['nombre'=>'Apple'],
            ['nombre'=>'Xiaomi'],
            ['nombre'=>'Logitech'],
            ['nombre'=>'Sony']
        ]);
    }
}