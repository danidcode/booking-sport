<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActividadRequest;
use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function index()
    {
        $actividades = Actividad::All();
        return view('panel-admin.actividades.index')->with('actividades', $actividades);
    }

    public function create()
    {
    }
    public function store(ActividadRequest $request)
    {

    }
    public function show()
    {
    }
    public function edit()
    {
    }
    public function update(ActividadRequest $request, Actividad $actividad)
    {
    }
    public function destroy()
    {
    }
}
