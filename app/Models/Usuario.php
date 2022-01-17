<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $guarded = [];

    protected $hidden = ['password'];


   public function personal()
    {
        return $this->hasOne(Personal::class, 'id', 'id_personal');
    }
}

