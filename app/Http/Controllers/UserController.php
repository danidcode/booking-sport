<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        return view('panel-admin.usuarios.index');
    }

    public function indexReservas(){
        return view('panel-user.reservas.index');
    }

    public function getReservasJson(Request $request){
        $user_id = Auth::user()->id;

        $reservas = Reserva::with('actividad')
        ->where('user_id',$user_id)
        ->where('fecha_reserva', '>=', Carbon::now()->toDateString());
        
        $reservas = $reservas->paginate(7);

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

    public function getUsuariosJson(Request $request)
    {

        $column = $request->column;
        $order = $request->order;
        $usuarios = User::when(isset($order) && isset($column), function ($q) use ($column, $order) {
            $q->orderBy($column, $order);
        })
        ->withCount('reserva')
        ->withCount('inscripcion');
        $usuarios = $usuarios->paginate(7)->onEachSide(1);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'usuarios' => $usuarios,
            ], 200);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Usuario borrado correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
