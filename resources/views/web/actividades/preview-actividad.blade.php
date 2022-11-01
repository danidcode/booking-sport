@extends('layouts.default')

@section('content')
<div class="preview-actividad">
    <div class="actividad">
        <div class="actividad-img">
            <img src="{{$actividad->imagen}}" alt="">
        </div>
        <div class="actividad-descripcion">
            <span>
                {{$actividad->descripcion}}
            </span>
        </div>
    </div>
    <div class="group">
  <input type="text" id="calendar-tomorrow">
  <span class="bar"></span>
  <label class="input-label">From tomorrow</label>
</div>
    <div class="confirmar-reserva-button">
        <button> Confirmar reserva </button>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{Vite::asset('resources/js/components/vanilla-calendar.min.js')}}"></script>
<script src="{{Vite::asset('resources/js/web/actividades/actividades.js')}}"></script>
@endsection