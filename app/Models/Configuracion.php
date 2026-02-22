<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    // Esto permite que Laravel guarde estos campos automáticamente
    protected $fillable = ['clave', 'valor'];
}
