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
            $actividad['dias_activo'] = json_encode($actividad['dias_activo']);
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
    public function update(Actividad $actividad, ActividadRequest $request)
    {
        try {
            $actividadValidated = $request->validated();
            $imagen = $actividad->imagen;
            $request->imagen == $actividad->imagen ?? ($imagen = imageInStorage($request->imagen));
            $actividadValidated['image'] = $imagen;
            $actividad->update($actividadValidated);
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

    public function getActividadesJson(Request $request)
    {
        $column = $request->column;
        $order = $request->order;
        $actividades = Actividad::when(isset($order) && isset($column), function ($q) use ($column, $order) {
            $q->orderBy($column, $order);
        });

        $actividades = $actividades->paginate(5);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'actividades' => $actividades,
            ], 200);
        }
    }

    public function previewActividad(Actividad $actividad)
    {
        return view('web.actividades.preview-actividad')->with('actividad', $actividad);
    }
}
