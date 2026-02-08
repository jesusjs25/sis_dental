<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = ['titulo','fecha', 'hora', 'paciente_id'];

    public function paciente() {
    return $this->belongsTo(Paciente::class);
}
}
