<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Evento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function show(){
        $actividades_destacadas = Actividad::where('destacado', 1)->get();
        $eventos_destacados = Evento::where('destacado', 1)
        ->where('fecha_inicio', '<', Carbon::now()->toDateString())->get();
        
        $eventos_destacados->transform(function ($evento) {
            $evento->fecha_inicio = getFecha($evento->fecha_inicio);

            return $evento;
        });
        $evento_principal = Evento::where('destacado_principal', 1)->first();

        $evento_principal->fecha_inicio = getFecha($evento_principal->fecha_inicio);
        return view('home')
        ->with('actividades', $actividades_destacadas)
        ->with('eventos', $eventos_destacados)
        ->with('evento_principal', $evento_principal);
    }
}
