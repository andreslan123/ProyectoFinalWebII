<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->updateOrInsert(
            ['nombre' => 'admin']
        );

        DB::table('roles')->updateOrInsert(
            ['nombre' => 'cliente']
        );

        DB::table('roles')->updateOrInsert(
            ['nombre' => 'vendedor']
        );
    }
}