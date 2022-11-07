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
        </div>
        <div class="confirmar-reserva-button">
            <button onclick="createReserva()"> Confirmar inscripción </button>
            <input type="hidden" id="evento_id" value="{{ $evento->id }}">
        </div>
    </div>
@endsection
