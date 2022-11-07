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
            {{-- <img src="storage/gente_corriendo.webp"> </img> --}}
        </div>

        <div class="home-actividades-destacadas" data-aos="fade-right" data-aos-offset="400" data-aos-easing="ease-in-sine">
            <div class="home-actividades-destacadas-text">
                <span> Actividades destacadas</span>
            </div>

            <div class="swiper mySwiper">
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

        <div class="home-eventos-destacados" data-aos="fade-right" data-aos-offset="400" data-aos-easing="ease-in-sine">
            <div class="home-eventos-destacados-text">
                <span> Eventos destacados</span>
            </div>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($actividades as $actividad)
                        <div class="swiper-slide"> <img src="{{ $actividad->imagen }}" alt=""> </img> </div>
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
