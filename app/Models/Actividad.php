<?php

namespace App\Models;

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
        'hora_desde',
        'hora_hasta',
        'destacado',
        'destacado_principal',
        'activo'
    ];
}
