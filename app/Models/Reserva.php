<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'actividad_id',
        'fecha_reserva',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function actividad(){
        return $this->belongsTo(Actividad::class);
    }
}
