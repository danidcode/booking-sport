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
        return view('home')
        ->with('actividades', $actividades_destacadas);
    }
}
