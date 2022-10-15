<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActividadRequest;
use App\Models\Actividad;
use Illuminate\Http\Request;
use Faker\Extension\Helper;

class ActividadController extends Controller
{
    public function index(Request $request)
    {
        return view('panel-admin.actividades.index');
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
            $actividad['hora_desde'] = '2022/11/10';
            $actividad['hora_hasta'] = '2022/11/10';
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
    public function show(Actividad $actividad, Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'actividad' => $actividad,
            ], 200);
        }
    }
    public function edit(Actividad $actividad, Request $request)
    {
        
    }
    public function update(Request $request)
    {
            dd($request);
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

    public function getActividadesJson(Request $request){
        $actividades = Actividad::All();
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'actividades' => $actividades,
            ], 200);
        }
    }
}
