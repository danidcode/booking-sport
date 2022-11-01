@extends('layouts.default')

@section('content')
    <div class="preview-actividad">
        <div class="actividad">
            <div class="actividad-nombre">
                <span> {{ $actividad->nombre }}</span>
            </div>
            <div class="actividad-img">
                <img src="{{ $actividad->imagen }}" alt="">
            </div>
            <div class="actividad-descripcion">
                <span>
                    {{ $actividad->descripcion }}
                </span>
            </div>
        </div>
        <div class="calendario">
            <span>Seleccionar día</span>
            <input type="text" id="calendar-reserva">
        </div>
        <div class="confirmar-reserva-button">
            <button onclick="createReserva()"> Confirmar reserva </button>
            <input type="hidden" id="actividad_id" value="{{$actividad->id}}">
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ Vite::asset('resources/js/components/vanilla-calendar.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/web/actividades/actividades.js') }}"></script>
@endsection
