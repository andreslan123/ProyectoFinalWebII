<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('estado_id')->constrained('estados_general');

            $table->string('titulo', 200);
            $table->text('descripcion')->nullable();
            $table->decimal('valor_descuento', 12, 2)->default(0);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
        });
    }

    public function down()
    {
        Schema::dropIfExists('promociones');
    }
};