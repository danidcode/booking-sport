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
        <li> <a href="/eventos">Eventos</a></li>
        <li> <a href="/actividades">Actividades</a></li>
        @auth
        <li><a href="dashboard" class="for-mobile">Panel de usuario</a></li>
        <li class="for-mobile">
            <button type="submit" form="form-logout" class="logout-btn">Cerrar sesión
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </li>
        <div class="dropdown" onclick="dropdownOptions('dropdownbtn-header')">
            <i class="fa-regular fa-user fa-lg dropdownbtn"></i>
            <div id="dropdown-list" class="dropdown-content">
                <a href="/dashboard">Panel de usuario</a>
                <button type="submit" form="form-logout" class="logout-btn">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i> </button>
                <form style="display: none" action="{{ route('auth.logout') }}" method="POST" id="form-logout">
                    @csrf
                </form>


            </div>
        </div>
        @else
        <li> <a href="/login">Iniciar sesión</a></li>
        @endauth
    </ul>
</div>