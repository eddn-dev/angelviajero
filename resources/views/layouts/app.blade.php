<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', 'AngelViajero')
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-white to-orange-200 min-h-screen">

    <x-layout.header /> {{-- Llama al componente header --}}

    {{-- Contenedor principal de la página --}}   

    <main class="px-4 py-8 border-t-4 border-orange-500"> {{-- Contenedor opcional para el contenido --}}
         @yield('content') {{-- El contenido específico de cada página se insertará aquí --}}
    </main>

    <a href="https://wa.me/5215638193041?text=¡Hola!%20Quisiera%20más%20información%20sobre%20los%20productos." 
    target="_blank" 
    rel="noopener noreferrer"
    class="fixed bottom-4 right-4 z-50 flex items-center justify-center w-16 h-16 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg transform transition duration-300 hover:scale-110">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-8 h-8" fill="currentColor">
            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-6.5-3.3-27.1-10-51.6-31.3-19.1-17.1-31.9-38.3-35.6-44.7-3.7-6.4-.4-9.9 2.7-13.1 2.8-2.8 6.4-7.1 9.6-10.6 3.2-3.7 4.3-6.4 6.4-10.7 2.1-4.3 1-6.9-.5-9.6-1.6-2.7-14.5-35-19.9-47.9-5.2-12.5-10.5-10.8-14.5-11-3.7-.2-8.1-.2-12.4-.2-4.3 0-11.3 1.6-17.2 7.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 40.6 17.6 56.4 19.1 76.5 16.1 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
        </svg>
    </a>


    <x-layout.footer /> {{-- Llama al componente footer --}}
</body>
</html>
