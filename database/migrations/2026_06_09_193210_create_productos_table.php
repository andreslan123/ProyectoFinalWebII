<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('subcategoria_id')->constrained('subcategorias');
            $table->foreignId('marca_id')->constrained('marcas');
            $table->foreignId('estado_id')->constrained('estados_general');

            $table->string('codigo', 50)->unique();
            $table->string('nombre', 200);
            $table->text('descripcion')->nullable();

            $table->decimal('precio_compra', 12, 2)->default(0);
            $table->decimal('precio_venta', 12, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};