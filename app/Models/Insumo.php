<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;
    protected $fillable = ['material_id'];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
