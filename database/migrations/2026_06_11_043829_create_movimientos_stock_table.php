<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('movimientos_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->string('tipo_movimiento', 50);
            $table->integer('cantidad');
            $table->text('descripcion')->nullable();
            $table->dateTime('fecha_movimiento');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movimientos_stock');
    }
};