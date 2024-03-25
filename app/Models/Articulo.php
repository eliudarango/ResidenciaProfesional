<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable = ['numero_serie', 'material_id'];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
