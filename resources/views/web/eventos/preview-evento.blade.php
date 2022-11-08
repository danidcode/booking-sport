@extends('layouts.default')

@section('content')
    <div class="preview-evento">
        <div class="evento">
            <div class="evento-nombre">
                <span> {{ $evento->nombre }}</span>
            </div>
            <div class="evento-img">
                <img src="{{ $evento->imagen }}" alt="">
            </div>
            <div class="evento-descripcion">
                <span>
                    {{ $evento->descripcion }}
                </span>
            </div>
            <div class="evento-fecha">
                <span>
                    {{ $evento->fecha_inicio }}
                </span>
            </div>
        </div>
        <div class="confirmar-evento-button">
            <button onclick="createInscripcion()"> Inscribirse </button>
            <input type="hidden" id="evento_id" value="{{ $evento->id }}">
        </div>
    </div>
@endsection
