@extends('layouts.default')

@section('content')
    <div class="listado-actividades-wrap">

        <div class="listado-actividades">
        @foreach($actividades as $actividad)

        <div class="actividad-content">

            <div class="actividad">

            </div>
        </div>
        @endforeach
    </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ Vite::asset('resources/js/web/actividades/actividades.js') }}"></script>
@endsection
