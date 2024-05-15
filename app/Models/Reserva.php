<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'reservas';
    protected $fillable = [
        "ambiente",
        "hora_ini",
        "hora_fin",
        "periodo",
        "dia",
        'solicitud'
    ];
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}
