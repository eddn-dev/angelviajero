<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angel Viajero</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <x-layout.header /> {{-- Llama al componente header --}}

    {{-- Contenedor principal de la página --}}   

    <main class="container mx-auto px-4 py-8"> {{-- Contenedor opcional para el contenido --}}
         @yield('content') {{-- El contenido específico de cada página se insertará aquí --}}
    </main>

    <x-layout.footer /> {{-- Llama al componente footer --}}
</body>
</html>
