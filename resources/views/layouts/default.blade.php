<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/calendar/vanilla-calendar.min.css') }}" />
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/pagination-web/bootstrap.css') }}" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@dashboardcode/bsmultiselect@1.1.18/dist/css/BsMultiSelect.min.css">
    <title>Booking Sport</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/scss/main.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="global-wrapper">
    <header class="header">
        @include('components.header')
    </header>

    <div id="main" class="main">
        @yield('content')
        @include('components.spinner')
    </div>

    <footer class="footer">
        @include('components.footer')
    </footer>
</div>
</body>

@include('global-scripts.index')
@yield('scripts')

</html>
