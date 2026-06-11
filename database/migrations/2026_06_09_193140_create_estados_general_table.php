<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estados_general', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 50);
            $table->string('nombre', 100);

            $table->unique(['tipo', 'nombre'], 'uq_catalogo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estados_general');
    }
};