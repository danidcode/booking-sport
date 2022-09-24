<div class="logo">
    <a href="/">
        <img src={{ Vite::asset('resources/images/logo_empresa6.png') }} alt="">
    </a>
</div>

<div class="navegacion">
    <input type="checkbox" class="toggle-menu">
    <div class="burger"></div>
    <ul class="menu">
        <li> <a href="/">Home</a></li>
        <li> <a href="#">Eventos</a></li>
        <li> <a href="#">Actividades</a></li>
        @if(Auth::user())
        <li> <a><i class="fa-regular fa-user fa-lg"></i> </a> </li>
        @else
        <li> <a href="/login">Iniciar sesión</a></li>
        @endif
    </ul>
</div>
