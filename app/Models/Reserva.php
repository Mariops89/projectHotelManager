<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $guarded = [];


    public function scopeIntervalo($query, $inicio, $fin)
    {
        return $query->where('fecha_salida', '>=', $inicio)->where('fecha_entrada', '<=', $fin);
    }


    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'id_habitacion');
    }


    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function factura()
    {
        return $this->hasOne(Factura::class, 'id_reserva');
    }
}
