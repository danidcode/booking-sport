@extends('layouts.default')

@section('content')
    <div class="listado-actividades-wrap">

        <div class="listado-actividades">
            @foreach ($actividades as $actividad)
                    <div class="actividad">
                        <img src="{{ $actividad->imagen }}" alt="" class="actividad-image" />
                        <div class="actividad-wrap">
                        <div class="actividad-text-content">
                            <h2 class="actividad-title">{{ $actividad->nombre }}</h2>
                            <div class="actividad-date">
                                <span>{{$actividad->id}}</span>
                            </div>

                        </div>
                    </div>
                    </div>
            @endforeach
            {{ $actividades->onEachSide(5)->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ Vite::asset('resources/js/web/actividades/actividades.js') }}"></script>
@endsection
