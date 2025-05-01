<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo')->default('proteina'); // proteina | extra | envoltura
            $table->boolean('se_repite')->default(true);
            $table->boolean('mostrar')->default(true); // para ocultar vegetales o internos
            $table->integer('precio_base')->default(0); // costo por unidad
            $table->integer('precio_repeticion')->default(1000); // adicional por repetición
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('ingredientes');
    }
};
