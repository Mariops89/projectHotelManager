<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $table = 'login';

    protected $guarded = [];


    public function getEstadoAttribute($value)
    {
        return ucfirst($value);
    }


    public function setEstadoAttribute($value)
    {
        $this->attributes['estado'] = mb_strtolower($value);
    }
}
