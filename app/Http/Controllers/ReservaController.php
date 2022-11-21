<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRequest;
use App\Models\Actividad;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{

    public function index()
    {
        return view('panel-admin.reservas.index');
    }
    public function store(ReservaRequest $request)
    {
        try {
            $reserva = $request->validated();
            $date = new Carbon($reserva['fecha_reserva']);
            $dayOfWeek = $date->dayOfWeek;
            $actividad = Actividad::where('id', $reserva['actividad_id'])
                ->withCount(['reserva' => function (Builder $query) use ($date) {
                    $query->where('fecha_reserva', $date->toDateString());
                }])
                ->first();
            if (!isset($reserva)) {
                return response()->json([
                    'status' => false,
                    'message' => 'La reserva seleccionada no existe'
                ], 500);
            }

            $dias_activos = json_decode($actividad->dias_activo);
            $user_id = Auth::user()->id;
            $reserva['user_id'] = $user_id;
            if (!in_array($dayOfWeek, $dias_activos)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ha seleccionado un día que no está activo'
                ], 500);
            }
            if (!$actividad->activo) {
                return response()->json([
                    'status' => false,
                    'message' => 'La actividad no se encuentra activa'
                ], 500);
            }
            if (Reserva::where('user_id', $user_id)
                ->where('fecha_reserva', $date->toDateString())
                ->count()
            ) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ya has reservado en esta actividad en la fecha seleccionada'
                ], 500);
            }

            if ($actividad->reserva_count == $actividad->limite_usuarios) {
                return response()->json([
                    'status' => false,
                    'message' => 'Se ha llegado al límite de reservas en esta reserva por hoy'
                ], 500);
            }
            Reserva::create($reserva);
            return response()->json([
                'status' => true,
                'message' => 'Reserva creada correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getReservasJson(Request $request)
    {

        $column = $request->column;
        $order = $request->order;
        $reservas = Reserva::join('users', 'reservas.user_id', '=', 'users.id')
        ->join('actividades', 'reservas.actividad_id', '=', 'actividades.id')
        ->selectRaw('reservas.*, users.name as user_nombre, users.email as user_email, actividades.nombre as actividad_nombre')
        ->when(isset($order) && isset($column), function ($q) use ($column, $order) {
            $q->orderBy($column, $order);
        });
        
        try {
            $reservas = $reservas->paginate(7)->onEachSide(1);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        
        
        // $reservas = $reservas->paginate(7)->onEachSide(1);

        $reservas->getCollection()->transform(function ($reserva) {
            $reserva->estado = $reserva->fecha_reserva < Carbon::now()->toDateString() ? false : true;

            return $reserva;
        });

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'reservas' => $reservas,
            ], 200);
        }
    }

    public function destroy(Reserva $reserva)
    {
        try {
            $reserva->delete();
            return response()->json([
                'status' => true,
                'message' => 'Reserva borrada correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
