<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Limpieza
{
    use HasFactory;

    protected $table = 'limpieza';

    protected $guarded = [];

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'id_habitacion');
    }


    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_reserva');
    }
}
