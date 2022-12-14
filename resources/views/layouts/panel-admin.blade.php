<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Booking Sport</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css','resources/css/main.css', 'resources/js/app.js'])
</head>
@php
$routeName = Route::current()->getName()
@endphp

<body>

    <div id="main" class="main">
        @include('components.spinner')
        <div class="sidebar">
            <a class="@if(strpos($routeName, 'dashboard') === 0) active  @endif" href="/dashboard">Home</a>
            <a class="@if(strpos($routeName, 'admin.actividades.') === 0) active  @endif" href="/admin/actividades">Configurar Actividades</a>
            <a class="@if(strpos($routeName, 'admin.eventos.') === 0) active  @endif" href="/admin/eventos">Configurar Eventos</a>
            <a class="@if(strpos($routeName, 'admin.reservas.') === 0) active  @endif" href="/admin/reservas">Ver Reservas</a>
            <a class="@if(strpos($routeName, 'admin.inscripciones.') === 0) active  @endif" href="/admin/inscripciones">Ver Inscripciones</a>
            <a class="@if(strpos($routeName, 'admin.lista-usuarios.') === 0) active  @endif" href="/admin/lista-usuarios">Lista de usuarios</a>
            <a class="" href="/">Volver a la página principal</a>
            {{-- <a class="" href="#about">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i></a> --}}
            <button type="submit" form="form-logout" class="logout-btn">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i> </button>
            <form style="display: none" action="{{ route('auth.logout') }}" method="POST" id="form-logout">
                @csrf
            </form>
        </div>
        @yield('content')
    </div>

</body>

@include('global-scripts.index')

@yield('scripts')

</html>