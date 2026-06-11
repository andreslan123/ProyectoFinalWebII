<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
<<<<<<< HEAD
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        
        // Campos nuevos para tu proyecto
        $table->unsignedBigInteger('rol_id')->nullable(); 
        $table->integer('estado_id')->default(1);
        
        // Campos estructurales de Laravel (¡Solo una vez!)
        $table->rememberToken();
        $table->timestamps();
=======
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
>>>>>>> 934b512a9c5e297e79b3d75d2833a1af769e596d
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};