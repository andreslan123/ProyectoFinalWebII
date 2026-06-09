<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
    Schema::create('proveedores', function (Blueprint $table) {
        $table->id();
        $table->integer('estado_id')->default(1);
        $table->string('nombre_empresa');
        $table->string('nit');
        $table->string('correo');
        $table->string('direccion');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
};
