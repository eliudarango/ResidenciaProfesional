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
        Schema::create('prestamos_alumnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_apartado')->constrained('apartado_alumnos');
            $table->date('fecha');
            $table->string('alumno');
            $table->time('hora_inicial');
            $table->time('hora_final');
            $table->string('carrera');
            $table->string('aula');
            $table->string('numero_control');
            $table->string('profesor');
            $table->string('telefono');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos_alumnos');
    }
};
