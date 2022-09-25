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
        @auth
        <div class="dropdown" onclick="showUserOptions()">
            <i class="fa-regular fa-user fa-lg dropdownbtn"></i>
            <div id="dropdown-list" class="dropdown-content">
                <a href="dashboard">Panel de cliente</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i> </button>
                </form>
            </div>
        </div>
        @else
        <li> <a href="/login">Iniciar sesión</a></li>
        @endauth
    </ul>
</div>