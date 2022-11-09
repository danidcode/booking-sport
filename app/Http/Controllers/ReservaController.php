<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRequest;
use App\Models\Actividad;
use App\Models\Reserva;
use Carbon\Carbon;
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
            $actividad = Actividad::findOrFail($reserva['actividad_id'])->first();
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
