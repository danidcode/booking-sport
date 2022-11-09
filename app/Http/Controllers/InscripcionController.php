<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscripcionRequest;
use App\Models\Actividad;
use App\Models\Evento;
use App\Models\Inscripcion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    public function store(InscripcionRequest $request)
    {

        try {
            $inscripcion = $request->validated();
            $evento = Evento::where('id',$inscripcion['evento_id'])->withCount('inscripcion')->first();
            $user_id = Auth::user()->id;
            $inscripcion['user_id'] = $user_id;

            if(!isset($evento)){
                return response()->json([
                    'status' => false,
                    'message' => 'El evento seleccionado no existe'
                ], 500); 
            }
            if($evento->fecha_inicio <= Carbon::now()->toDateString()){
                return response()->json([
                    'status' => false,
                    'message' => 'El tiempo para inscribirse a este evento ya ha expirado'
                ], 500);
            }
            if($evento->inscripcion_count == $evento->limite_usuarios){
                return response()->json([
                    'status' => false,
                    'message' => 'Se han agotado las plazas para inscribirse a este evento'
                ], 500);
            }

            Inscripcion::create($inscripcion);
            return response()->json([
                'status' => true,
                'message' => 'inscripcion creada correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
