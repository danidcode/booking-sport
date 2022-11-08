<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscripcionRequest;
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
            $evento = Evento::findOrFail($inscripcion['evento_id'])->first();
            $user_id = Auth::user()->id;
            $inscripcion['user_id'] = $user_id;
            if(Inscripcion::where('user_id',$user_id)
            ->where('fecha_inscripcion', $date->toDateString())
            ->count()){
                return response()->json([
                    'status' => false,
                    'message' => 'Ya te has inscrito en este evento'
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
