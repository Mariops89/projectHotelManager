<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $guarded = [];


   public function personal()
    {
        return $this->hasOne(Personal::class, 'id', 'id_personal');
    }
}

