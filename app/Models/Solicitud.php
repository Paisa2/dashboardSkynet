<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';
    protected $fillable = ['cantidad',
                            'motivo',
                            'hora_ini',
                            'hora_fin',
                            'periodo',
                            'dia',
                            'estado',
                            'ambiente',
                            'docmateria_id',


    ];

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function docmateria()
    {
        return $this->belongsTo(Docmateria::class);
    }

    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class);
    }
}
