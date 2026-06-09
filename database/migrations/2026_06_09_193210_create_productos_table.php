<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
   {
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('subcategoria_id')->constrained('subcategorias')->onDelete('cascade');
        $table->foreignId('marca_id')->constrained('marcas')->onDelete('cascade');
        $table->integer('estado_id')->default(1);
        $table->string('codigo_barra'); // o 'codigo' según lo definieron
        $table->string('nombre');
        $table->text('descripcion')->nullable();
        $table->decimal('precio_venta', 10, 2);
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
        Schema::dropIfExists('productos');
    }
};
