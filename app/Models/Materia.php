<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materias';
    protected $fillable = ['codigo', 'nombre', 'carrera', 'nivel', 'tipo', 'estado'];

    public function docmaterias()
    {
        return $this->hasMany(Docmateria::class);
    }
}
