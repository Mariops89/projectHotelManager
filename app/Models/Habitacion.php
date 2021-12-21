<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitaciones';

    protected $guarded = [];


    public function getEstadoAttribute($value)
    {
        return ucfirst($value);
    }


    public function setEstadoAttribute($value)
    {
        $this->attributes['estado'] = mb_strtolower($value);
    }


    public function tipo()
    {
        return $this->hasOne(TipoHabitacion::class, 'id', 'id_tipo_habitacion');
    }
}
