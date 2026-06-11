<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('producto_proveedor', function (Blueprint $table) {
            $table->id();

            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('proveedor_id')->constrained('proveedores');

            $table->decimal('precio_compra', 12, 2)->default(0);
            $table->string('codigo_proveedor', 100)->nullable();
            $table->boolean('principal')->default(false);

            $table->unique(['producto_id', 'proveedor_id'], 'uq_prod_prov');
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto_proveedor');
    }
};