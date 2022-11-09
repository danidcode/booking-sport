<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'limite_usuarios',
        'fecha_inicio',
        'destacado',
        'destacado_principal',
    ];
    public function inscripcion()
    {
        return $this->hasMany(Inscripcion::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
