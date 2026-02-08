<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function user() {

        return $this->belongsTo(User::class);

    }

    public function doctor() {

        return $this->belongsTo(Doctor::class);

    }

    public function consultorio() {

        return $this->belongsTo(Consultorio::class);

    }
}
