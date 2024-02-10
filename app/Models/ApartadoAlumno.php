<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartadoAlumno extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_inventario',
        'fecha',
        'alumno',
        'hora_inicial',
        'hora_final',
        'aula',
        'carrera',
       
    ];
}
