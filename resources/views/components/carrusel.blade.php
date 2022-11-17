
<div class="carrusel-container">

    @foreach ($registros as $registro)
        <div class="slide">
            <img src="{{ $registro->imagen }}">
            <div class="slide-content">
                <span>{{ $registro->nombre }}</span>
                <div> <a href="{{$ruta_boton}}/{{$registro->id}}" class="tarjeta-inscripcion-button"> {{$texto_boton}} </a></div>
            </div>
        </div>
    @endforeach

    <a class="prev" onclick="setSlide(-1)">&#10094;</a>
    <a class="next" onclick="setSlide(1)">&#10095;</a>
</div>

