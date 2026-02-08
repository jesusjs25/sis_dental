<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Paciente extends Model
{
    use HasRoles,HasFactory;
    
    protected $guard_name = 'web';
    
    protected $table ='pacientes';
    
    protected $fillable = [
        'tipo_identificacion',
        'identificacion',
        'nombres',
        'apellidos',
        'correo_electronico',
        'f_nacimiento',
        'edad',
        'direccion',
        'telefono',
    ];
}
