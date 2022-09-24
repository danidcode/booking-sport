<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Booking Sport</title>

      <!-- Scripts -->
      @vite(['resources/css/app.css','resources/scss/main.scss', 'resources/js/app.js'])
</head>

<body>
    <header class="header">
        @include('components.header')
    </header>

    <div id="main" class="main">
        @yield('content')
    </div>

    <footer class="footer">
        @include('components.footer')
    </footer>
</body>

</html>