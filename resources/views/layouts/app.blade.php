<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 with Bootstrap</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>

    <div id="app">
        @yield('content')
    </div>
</body>
</html>
