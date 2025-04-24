{{-- resources/views/components/layout/header.blade.php --}}
{{-- Componente de Header con menú móvil mejorado y resaltado de sección activa --}}

<header class="bg-white shadow-md sticky top-0 z-50">
    {{-- Contenedor principal de la navegación --}}
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">

        {{-- Logo / Nombre del Sitio --}}
        <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800 hover:text-orange-700 transition duration-300">
            Angel<span class="text-orange-600">Viajero</span>
        </a>

        {{-- Menú de Navegación para Escritorio (Oculto en móvil) --}}
        <div class="hidden md:flex space-x-4 lg:space-x-6 items-center">
            {{-- Enlace Inicio --}}
            <a href="{{ route('home') }}"
               @class([
                   'px-3 py-2 rounded-md text-sm font-medium transition duration-300', // Clases base
                   'text-orange-600 font-semibold border-b-2 border-orange-500' => request()->routeIs('home'), // Clases si está activo
                   'text-gray-600 hover:text-orange-600 hover:bg-gray-50' => !request()->routeIs('home'), // Clases si está inactivo
               ])>
                Inicio
            </a>

            {{-- Enlace Tienda --}}
            <a href="{{ route('tienda.index') }}"
               @class([
                   'px-3 py-2 rounded-md text-sm font-medium transition duration-300',
                   'text-orange-600 font-semibold border-b-2 border-orange-500' => request()->routeIs('tienda.index'), // Cambia 'tienda.*' si quieres resaltar en subpáginas de tienda también
                   'text-gray-600 hover:text-orange-600 hover:bg-gray-50' => !request()->routeIs('tienda.index'),
               ])>
                Tienda
            </a>

            {{-- Enlace Promociones (Ofertas) --}}
            {{-- Usamos 'promociones.*' para que se mantenga activo si hubiera subpáginas de promociones --}}
            <a href="{{ route('promociones.index') }}"
               @class([
                   'px-3 py-2 rounded-md text-sm font-medium transition duration-300 flex items-center gap-1', // Añadido flex y gap para el icono
                   'text-orange-600 font-semibold border-b-2 border-orange-500' => request()->routeIs('promociones.index'),
                   'text-gray-600 hover:text-orange-600 hover:bg-gray-50' => !request()->routeIs('promociones.index'),
               ])>
                <span class="text-base">🔥</span> {{-- Icono de fuego --}}
                <span>Ofertas</span>
            </a>

            {{-- Enlace Contacto --}}
            <a href="{{ route('contacto.index') }}"
               @class([
                   'px-3 py-2 rounded-md text-sm font-medium transition duration-300',
                   'text-orange-600 font-semibold border-b-2 border-orange-500' => request()->routeIs('contacto.index'),
                   'text-gray-600 hover:text-orange-600 hover:bg-gray-50' => !request()->routeIs('contacto.index'),
               ])>
                Contacto
            </a>
        </div>

        {{-- Iconos Derecha (Carrito y Botón Menú Móvil) --}}
        <div class="flex items-center space-x-2 sm:space-x-4">
            {{-- Icono Carrito con Contador --}}
            <a href="{{ route('carrito.index') }}" class="relative text-gray-600 hover:text-orange-600 p-2 transition duration-300">
                {{-- Icono SVG de carrito --}}
                <svg id="cart-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                {{-- Contador (se actualiza por JS) --}}
                <span id="cart-counter" class="absolute -top-1 -right-1 bg-orange-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center hidden">
                    0
                </span>
            </a>

            {{-- Botón Menú Móvil (Visible solo en pantallas pequeñas) --}}
            <button class="md:hidden text-gray-600 hover:text-orange-600 focus:outline-none p-2" id="mobile-menu-button" aria-label="Abrir menú">
                {{-- Icono Hamburguesa (puedes cambiarlo si prefieres) --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </nav>

    {{-- Menú Desplegable Móvil --}}
    {{-- Se muestra/oculta con JS (ver resources/js/app.js) --}}
    {{-- Mejoras: Padding, borde superior, fondo ligeramente distinto, enlaces más grandes --}}
    <div class="md:hidden hidden bg-gray-50 border-t shadow-inner" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            {{-- Enlace Inicio (Móvil) --}}
            <a href="{{ route('home') }}"
               @class([
                   'block px-3 py-3 rounded-md text-base font-medium transition duration-150 ease-in-out',
                   'bg-orange-100 text-orange-700' => request()->routeIs('home'),
                   'text-gray-700 hover:text-orange-600 hover:bg-gray-100' => !request()->routeIs('home'),
               ])>
               Inicio
            </a>
            {{-- Enlace Tienda (Móvil) --}}
            <a href="{{ route('tienda.index') }}"
               @class([
                   'block px-3 py-3 rounded-md text-base font-medium transition duration-150 ease-in-out',
                   'bg-orange-100 text-orange-700' => request()->routeIs('tienda.index'),
                   'text-gray-700 hover:text-orange-600 hover:bg-gray-100' => !request()->routeIs('tienda.index'),
               ])>
               Tienda
            </a>
            {{-- Enlace Promociones (Móvil) --}}
            <a href="{{ route('promociones.index') }}"
               @class([
                   'block px-3 py-3 rounded-md text-base font-medium transition duration-150 ease-in-out flex items-center gap-2', // Añadido flex y gap
                   'bg-orange-100 text-orange-700' => request()->routeIs('promociones.index'),
                   'text-gray-700 hover:text-orange-600 hover:bg-gray-100' => !request()->routeIs('promociones.index'),
               ])>
               <span class="text-lg">🔥</span>
               <span>Ofertas</span>
            </a>
            {{-- Enlace Contacto (Móvil) --}}
            <a href="{{ route('contacto.index') }}"
               @class([
                   'block px-3 py-3 rounded-md text-base font-medium transition duration-150 ease-in-out',
                   'bg-orange-100 text-orange-700' => request()->routeIs('contacto.index'),
                   'text-gray-700 hover:text-orange-600 hover:bg-gray-100' => !request()->routeIs('contacto.index'),
               ])>
               Contacto
            </a>
        </div>
    </div>
</header>
