<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function show(){
        // $evento_principal = Evento::where('destacado_principal', 1)->first();
        return view('home');
    }
}
