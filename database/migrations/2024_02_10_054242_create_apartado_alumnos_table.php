<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apartado_alumnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_inventario')->constrained('inventarios');
            $table->date('fecha');
            $table->string('alumno');
            $table->time('hora_inicial');
            $table->time('hora_final');
            $table->string('aula');
            $table->string('carrera');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartado_alumnos');
    }
};
