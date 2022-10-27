@extends('layouts.default')
@section('content')
    <div class="home">
        <div class="home-evento-principal">
            <div class="tarjeta-inscripcion">
                <div class="home-evento-titulo">
                    <span> Carrera benéfica por Camilo Sánchez </span>
                </div>
                <div class="home-evento-fecha">
                    <span> 20 de noviembre </span>
                </div>
                <div>
                    <button class="tarjeta-inscripcion-button"> Inscríbete ya! </button>
                </div>


            </div>
            <img src="storage/gente_corriendo.webp"> </img>
        </div>

        <div class="home-actividades-destacadas">
            <div class="home-actividades-destacadas-text">
                <span> Actividades destacadas</span>
            </div>
        <div class="swiper swiper-home">
            <div class="swiper-wrapper">
                @foreach ($actividades as $actividad)
                <div class="swiper-slide">
                <div class="actividad-card">
                   <div class="actividad-card-text">
                         {{$actividad->nombre}}
                   </div>
                   <div class="actividad-card-img">
                      <img src="{{$actividad->imagen}}" alt="">
                   </div>
    
                </div>
            </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
    @stop

    @section('scripts')
    <script src={{ Vite::asset('resources/js/home/home.js') }}></script>
@endsection
