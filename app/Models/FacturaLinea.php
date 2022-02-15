<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaLinea extends Model
{
    use HasFactory;

    protected $table = 'lineasfacturas';

    protected $guarded = [];

}
