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
        try {
            $actividad = $request->validated();
            $imagen = imageInStorage($request->imagen);
            $actividad['imagen'] = $imagen;
            Actividad::create($actividad);
            return response()->json([
                'status' => true,
                'message' => 'Actividad creada correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function show()
    {
    }
    public function edit()
    {
    }
    public function update(ActividadRequest $request, Actividad $actividad)
    {

        try {
            $actividad = $request->validated();
            $imagen = imageInStorage($request->imagen);
            $actividad['image'] = $imagen;
            $actividad->update($actividad);
            return response()->json([
                'status' => true,
                'message' => 'Actividad actualizada correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function destroy(Request $request, Actividad $actividad)
    {
        try {
            $actividad->delete();
            return response()->json([
                'status' => true,
                'message' => 'Actividad borrada correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
