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
        @vite(['resources/css/app.css','resources/scss/main.scss', 'resources/js/app.js'])
    </head>
@php
$routeName = Route::current()->getName()
@endphp
<body>

    <div id="main" class="main">
        @include('components.spinner')
        <div class="sidebar">
            <a class="@if(strpos($routeName, 'dashboard') === 0) active  @endif" href="/dashboard">Home</a>
            <a class="@if(strpos($routeName, 'user.reservas.') === 0) active  @endif" href="/user/reservas">Mis reservas</a>
            <a class="@if(strpos($routeName, 'user.inscripciones.') === 0) active  @endif" href="/user/inscripciones">Mis inscripciones</a>
            <a class="" href="/">Volver a la página principal</a>
            <a class="" href="#about">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i></a>
          </div>
        @yield('content')
    </div>

    <footer class="footer">
        @include('components.footer')
    </footer>
</body>

@include('global-scripts.index')
@yield('scripts')
</html>