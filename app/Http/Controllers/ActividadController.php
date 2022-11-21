<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActividadRequest;
use App\Models\Actividad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Faker\Extension\Helper;
use Illuminate\Database\Eloquent\Builder;

class ActividadController extends Controller
{
    public function index()
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
    public function update(Actividad $actividad, ActividadRequest $request)
    {
        try {
            $actividadValidated = $request->validated();
            $imagen = $actividad->imagen;
            $request->imagen != $actividad->imagen ? $imagen = imageInStorage($request->imagen) : null;
            $actividadValidated['imagen'] = $imagen;
            $actividadValidated['limite_usuarios'] = $actividad->limite_usuarios;
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
    public function destroy(Actividad $actividad)
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
        })
            ->withCount(['reserva' => function (Builder $query) {
                $query->where('fecha_reserva', Carbon::now()->toDateString());
            }]);

        $actividades = $actividades->paginate(5)->onEachSide(1);
        $actividades->getCollection()->transform(function ($actividad) {
            $actividad->dias_activo = $this->formarDias(json_decode($actividad->dias_activo));

            return $actividad;
        });
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

    public function actividadesWeb()
    {
        $actividades = Actividad::where('activo', 1)->paginate(10);
        $actividades->getCollection()->transform(function ($actividad) {
            $actividad->dias_activo = $this->formarDias(json_decode($actividad->dias_activo));

            return $actividad;
        });
        return view('web.actividades.listado-actividades')->with('actividades', $actividades);
    }

    public function formarDias($actividad)
    {
        $dias = [];
        $dias_activos = '';
        $dias[1] = 'lunes';
        $dias[2] = 'martes';
        $dias[3] = 'miércoles';
        $dias[4] = 'jueves';
        $dias[5] = 'viernes';
        $dias[6] = 'sábado';
        $dias[7] = 'domingo';

        foreach ($actividad as $key => $dia) {
            if (count($actividad) == $key + 1) {
                $dias_activos = $dias_activos . ' ' . 'y' . ' ' .  $dias[$dia];
            } else {
                $dias_activos = $key != 0
                    ? ($dias_activos . ', ' . $dias[$dia])
                    : ($dias_activos . ' ' . ucfirst($dias[$dia]));
            }
        }
        return $dias_activos;
    }
}
