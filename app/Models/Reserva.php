<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'actividad_id',
        'user_id',
        'fecha_reserva',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function actividad(){
        return $this->belongsTo(Actividad::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
