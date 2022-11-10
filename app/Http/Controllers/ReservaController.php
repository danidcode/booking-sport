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
    public function store(ReservaRequest $request)
    {
        try {
            $reserva = $request->validated();
            $date = new Carbon($reserva['fecha_reserva']);
            $dayOfWeek = $date->dayOfWeek;
            $actividad = Actividad::where('id',$reserva['actividad_id'])
            ->withCount(['reserva' => function(Builder $query) use ($date){
                $query->where('fecha_reserva', $date->toDateString());
            }])
            ->first();
            if(!isset($actividad)){
                return response()->json([
                    'status' => false,
                    'message' => 'La actividad seleccionada no existe'
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
            if(Reserva::where('user_id',$user_id)
            ->where('fecha_reserva', $date->toDateString())
            ->count()){
                return response()->json([
                    'status' => false,
                    'message' => 'Ya has reservado en esta actividad en la fecha seleccionada'
                ], 500);
            }
            
            if ($actividad->reserva_count == $actividad->limite_usuarios) {
                return response()->json([
                    'status' => false,
                    'message' => 'Se ha llegado al límite de reservas en esta actividad por hoy'
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
}
