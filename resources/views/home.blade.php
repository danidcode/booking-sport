@extends('layouts.default')
@section('content')
    <div class="home">
        <div class="home-evento-principal">
            <div class="tarjeta-inscripcion">
                <div class="home-evento-titulo">
                    <span> {{$evento_principal->nombre}} </span>
                </div>
                <div class="home-evento-fecha">
                    <span> {{$evento_principal->fecha_inicio}} </span>
                </div>
                <div>
                    <a href="inscripcion-evento/{{$evento_principal->id}}" class="tarjeta-inscripcion-button"> Inscríbete ya! </a>
                </div>


            </div>
            <img src="{{$evento_principal->imagen}}"> </img>
        </div>

        <div class="home-actividades-destacadas">
            <div class="home-actividades-destacadas-text">
                <span> Actividades destacadas</span>
            </div>

            <div class="swiper home-swiper">
                <div class="swiper-wrapper">
                    @foreach ($actividades as $actividad)
                        <div class="swiper-slide">
                            <img src="{{ $actividad->imagen }}" alt=""> </img>
                            <div class="swiper-slide-actividad-content">
                                <span> {{ $actividad->nombre }}</span>
                                <div> <a href="reservar-actividad/{{$actividad->id}}" class="tarjeta-inscripcion-button"> Reservar </a></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <div class="home-eventos-destacados">
            <div class="home-eventos-destacados-text">
                <span> Eventos destacados</span>
            </div>

            <div class="swiper home-swiper">
                <div class="swiper-wrapper">
                    @foreach ($eventos as $evento)
                    <div class="swiper-slide">
                        <img src="{{ $evento->imagen }}" alt=""> </img>
                        <div class="swiper-slide-actividad-content">
                            <span> {{ $evento->nombre }}</span>
                            <span> {{$evento->fecha_inicio}}</span>
                            <div> <a href="inscripcion-evento/{{$evento->id}}" class="tarjeta-inscripcion-button"> Inscribirse </a></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src={{ Vite::asset('resources/js/home/home.js') }}></script>
@endsection
