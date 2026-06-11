<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('producto_imagenes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');

            $table->string('imagen', 500);
            $table->foreignId('estado_id')->constrained('estados_general');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto_imagenes');
    }
};