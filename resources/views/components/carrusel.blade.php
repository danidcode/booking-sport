
<div class="carrusel-container">

    @foreach ($actividades as $actividad)
        <div class="slide">
            <img src="{{ $actividad->imagen }}">
            <div class="slide-content">
                <span>{{ $actividad->nombre }}</span>
                <div> <a href="reservar-actividad/{{$actividad->id}}" class="tarjeta-inscripcion-button"> Reservar </a></div>
            </div>
        </div>
    @endforeach

    <a class="prev" onclick="setSlide(-1)">&#10094;</a>
    <a class="next" onclick="setSlide(1)">&#10095;</a>
</div>

