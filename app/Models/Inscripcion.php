<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';

    protected $fillable = [
        'evento_id',
        'user_id',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

