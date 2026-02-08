<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    
    
    protected $fillable = [
                    
                        'nombre',
                        'ubicacion',
                        'capacidad',
                        'telefono',
                        'especialidad', 
                        'estado',  
    ];
    
    public function doctores(){

        return $this->hasMany(Doctor::class);
    }

    public function horarios(){
        
        return $this->hasMany(Horario::class);
    }
    public function events(){
            return $this->hasMany(Event::class);
    }

}
