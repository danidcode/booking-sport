@extends('layouts.default')
@section('content')
    <div class="home">
        @if (isset($evento_principal))
            <div class="home-evento-principal">
                <div class="tarjeta-inscripcion">
                    <div class="home-evento-titulo">
                        <span> {{ $evento_principal->nombre }} </span>
                    </div>
                    <div class="home-evento-fecha">
                        <span> {{ $evento_principal->fecha_inicio }} </span>
                    </div>
                    <div>
                        <a href="inscripcion-evento/{{ $evento_principal->id }}" class="tarjeta-inscripcion-button">
                            Inscríbete ya! </a>
                    </div>


                </div>
                <img src="{{ $evento_principal->imagen }}"> </img>
            </div>
        @endif

        @if ($actividades->isNotEmpty())
            <div class="home-actividades-destacadas">
                <div class="home-actividades-destacadas-text">
                    <span> Actividades destacadas</span>
                </div>
                @include('components/carrusel', ['registros' => $actividades,'ruta_boton' => 'reservar-actividad', 'texto_boton' => 'Reservar', 'tipo' => 'actividad'])
            </div>
        @endif
            
        @if ($eventos->isNotEmpty())
            <div class="home-eventos-destacados">
                <div class="home-eventos-destacados-text">
                    <span> Eventos destacados</span>
                </div>
                @include('components/carrusel', ['registros' => $eventos,'ruta_boton' => 'inscripcion-evento', 'texto_boton' => 'Inscribirse', 'tipo' => 'evento'])
            </div>
    </div>
    @endif
@stop

@section('scripts')
    <script src={{ Vite::asset('resources/js/home/home.js') }}></script>
    <script src={{ Vite::asset('resources/js/components/carrusel.js') }}></script>
@endsection
