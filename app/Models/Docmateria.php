<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docmateria extends Model
{
    use HasFactory;
    protected $table = 'docmaterias';
    protected $fillable = ['inscritos','gestion','estado','grupo','materia','docente'];


    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}
