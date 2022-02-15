<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';

    protected $guarded = [];


    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_reserva');
    }


    public function lineas()
    {
        return $this->hasMany(FacturaLinea::class, 'id_factura');
    }
}
