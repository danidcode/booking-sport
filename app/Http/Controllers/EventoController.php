<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventoRequest;
use App\Models\Evento;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        return view('panel-admin.eventos.index');
    }


    public function create()
    {
    }
    public function store(EventoRequest $request)
    {
        try {
            $evento = $request->validated();
            $imagen = imageInStorage($request->imagen);
            $evento['imagen'] = $imagen;
            if ($evento['destacado_principal'] == 1 && Evento::where('destacado_principal', 1)->count() > 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ya existe un evento como destacado principal, debe quitarlo si desea poner este'
                ], 500);
            }
            Evento::create($evento);
            return response()->json([
                'status' => true,
                'message' => 'evento creado correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function show(Evento $evento, Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'evento' => $evento,
            ], 200);
        }
    }
    public function update(Evento $evento, EventoRequest $request)
    {
        try {
            $eventoValidated = $request->validated();
            $imagen = $evento->imagen;
            $request->imagen != $evento->imagen ? $imagen = imageInStorage($request->imagen) : null;
            $eventoValidated['imagen'] = $imagen;
            $eventoValidated['limite_usuarios'] = $evento->limite_usuarios;

            if ($eventoValidated['destacado_principal'] == 1 && Evento::where('destacado_principal', 1)
                ->whereNot('id', $evento->id)
                ->count() > 0
            ) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ya existe un evento como destacado principal, debe quitarlo si desea poner este'
                ], 500);
            }
            $evento->update($eventoValidated);
            return response()->json([
                'status' => true,
                'message' => 'evento actualizada correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function destroy(Evento $evento)
    {
        try {
            $evento->delete();
            return response()->json([
                'status' => true,
                'message' => 'Evento borrado correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getEventosJson(Request $request)
    {
        $column = $request->column;
        $order = $request->order;
        $eventos = Evento::when(isset($order) && isset($column), function ($q) use ($column, $order) {
            // dd($order);
            $q->orderBy($column, $order);
        });
        $eventos = $eventos->paginate(5);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'eventos' => $eventos,
            ], 200);
        }
    }

    public function previewEvento(Evento $evento)
    {
        $evento->fecha_inicio = getFecha($evento->fecha_inicio);
        return view('web.eventos.preview-evento')->with('evento', $evento);
    }

    public function eventosWeb()
    {
        $eventos = Evento::where('fecha_inicio', '>', Carbon::now()->toDateString())->orderBy('fecha_inicio','asc')->paginate(10);
        $eventos->getCollection()->transform(function ($evento) {
            $evento->fecha_inicio = getFecha($evento->fecha_inicio);

            return $evento;
        });
        return view('web.eventos.listado-eventos')->with('eventos', $eventos);
    }
}
