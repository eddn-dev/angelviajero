<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- CSRF Token para peticiones AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Título dinámico con fallback al nombre de la app --}}
    <title>@yield('title', config('app.name', 'AngelViajero'))</title>

    {{-- Meta Descripción (bueno para SEO) --}}
    <meta name="description" content="@yield('description', 'Tramita tu licencia permanente con nosotros.')">

    {{-- Favicons - Coloca estos archivos en tu carpeta /public --}}
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    {{-- Directiva de Vite para cargar los assets (CSS y JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- End Meta Pixel Code -->
</head>
<body class="antialiased">
    @yield('content')
    @stack('scripts')
</body>
</html>