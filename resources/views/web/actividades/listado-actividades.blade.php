@extends('layouts.default')

@section('content')
    <div class="listado-actividades-wrap">
        <div class="title"> 
            <span> Actividades</span> </div>
        <div class="listado-actividades">
            @foreach ($actividades as $actividad)
                    <div class="actividad">
                        <a href="reservar-actividad/{{$actividad->id}}">
                            <img src="{{ $actividad->imagen }}" alt="" class="actividad-image" />
                        <div class="actividad-text-content">
                            <h2 class="actividad-title">{{ $actividad->nombre }}</h2>
                            <span>{{ $actividad->dias_activo }}</span>

                        </div>
                    </a>
                    </div>
            @endforeach
          
        </div>
        {!! $actividades->onEachSide(1)->links() !!}
    </div>
@endsection

@section('scripts')
    <script src="{{ Vite::asset('resources/js/web/actividades/actividades.js') }}"></script>
@endsection
