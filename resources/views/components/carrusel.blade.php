<!-- Slideshow container -->
<div class="slideshow-container">

    @foreach ($actividades as $actividad)
    <div class="mySlides fade">
      <img src="{{$actividad->imagen}}" style="width:100%">
      <div class="text">{{$actividad->nombre}}</div>
    </div>

    @endforeach
  
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
  <br>
  

