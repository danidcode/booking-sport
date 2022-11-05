<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function indexReservas(){
        return view('panel-user.reservas.index');
    }

    public function getReservasJson(Request $request){
        $user_id = Auth::user()->id;

        $reservas = Reserva::with('actividad')
        ->where('user_id',$user_id)
        ->where('fecha_reserva', '>=', Carbon::now()->toDateString());
        
        $reservas = $reservas->paginate(5);

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'reservas' => $reservas,
            ], 200);
        }
    }

    public function destroyReserva(Reserva $reserva){
        $user_id = Auth::user()->id;
        if($reserva->user_id == $user_id){
            $reserva->delete();
            return response()->json([
                'status' => true,
                'message' => 'Reserva borrada correctamente',
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Acción no autorizada'
            ], 500);
        }
    }
}
