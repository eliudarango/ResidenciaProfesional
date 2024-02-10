<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestamoAlumno extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_apartado',
        'fecha',
        'alumno',
        'hora_inicial',
        'hora_final',
        'carrera',
        'aula',
        'numero_control',
        'profesor',
        'telefono',
        
    ];
}
