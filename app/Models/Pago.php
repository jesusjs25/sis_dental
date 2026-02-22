<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = ['paciente_id', 'monto_usd', 'tasa_dia', 'monto_bs', 'metodo_pago', 'banco_destino','numero_operacion', 'vuelto_usd'];

    public function paciente() {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
