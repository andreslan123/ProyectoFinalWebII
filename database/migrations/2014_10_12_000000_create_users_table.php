<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('rol_id');
            $table->unsignedBigInteger('estado_id')->default(1);

            $table->string('name', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100)->nullable();
            $table->string('ci', 20)->unique();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};