<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MusicGuessr</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Neonderthaw&family=Satisfy&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>

<body id="body">
    <div id="bg-bricks">
        <div class="bg-gradient">
        </div>
        @yield('body')
    </div>
</body>
</html>
