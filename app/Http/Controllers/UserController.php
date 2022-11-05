<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function indexReservas(){
        return view('panel-user.reservas.index');
    }
}
