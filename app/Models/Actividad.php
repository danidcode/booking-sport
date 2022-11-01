<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'limite_usuarios',
        'dias_activo',
        'destacado',
        'destacado_principal',
        'activo'
    ];

    public function reserva()
    {
        return $this->hasMany(Reserva::class);
    }

    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
