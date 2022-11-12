@extends('layouts.default')

@section('content')
    <div class="listado-eventos-wrap">
        <div class="title"> 
            <span> Eventos</span> </div>
        <div class="listado-eventos">
            @foreach ($eventos as $evento)
                    <div class="evento">
                        <a href="inscripcion-evento/{{$evento->id}}">
                            <img src="{{ $evento->imagen }}" alt="" class="evento-image" />
                        <div class="evento-text-content">
                            <h2 class="evento-title">{{ $evento->nombre }}</h2>
                            <span>{{ $evento->fecha_inicio }}</span>

                        </div>
                    </a>
                    </div>
            @endforeach
          
        </div>
        {!! $eventos->onEachSide(1)->links() !!}
    </div>
@endsection

@section('scripts')
    <script src="{{ Vite::asset('resources/js/web/eventos/eventos.js') }}"></script>
@endsection
