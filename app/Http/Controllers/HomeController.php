<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function show(){
        $actividades_destacadas = Actividad::where('destacado', 1)->get();
        $evento_principal = Evento::where('destacado_principal', 1)->first();

        $evento_principal->fecha_inicio = getFecha($evento_principal->fecha_inicio);
        return view('home')
        ->with('actividades', $actividades_destacadas)
        ->with('evento_principal', $evento_principal);
    }
}
