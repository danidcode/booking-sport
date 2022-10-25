<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventoRequest;
use App\Models\Evento;
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
    public function show()
    {
    }
    public function edit()
    {
    }
    public function update()
    {
    }
    public function destroy()
    {
    }

    public function getEventosJson(Request $request)
    {
        $column = $request->column;
        $order = $request->order;
        $eventos = Evento::when(isset($order) && isset($column), function ($q) use ($column, $order) {
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
}
