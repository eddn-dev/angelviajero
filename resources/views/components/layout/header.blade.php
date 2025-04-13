<header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
        <a href="#" class="text-2xl font-bold text-gray-800">Angel<span class="text-orange-600">Viajero</span></a>

        <div class="hidden md:flex space-x-6 items-center">
            {{-- Enlace a la página que muestra todos los productos --}}
            <a href="/" class="text-gray-600 hover:text-orange-600 transition duration-300">
                Tienda 
            </a> 
            
            {{-- Novedades - Mantenlo si es relevante ahora, si no, puedes quitarlo --}}
            <a href="#" class="text-gray-600 hover:text-orange-600 transition duration-300">
                Novedades 
            </a>

            {{-- Ofertas - Destacado --}}
            <a href="#" class="font-semibold text-orange-600 hover:text-orange-700 transition duration-300">
                🔥 Ofertas 
            </a>

            {{-- Contacto / Ayuda --}}
            <a href="#" class="text-gray-600 hover:text-orange-600 transition duration-300">
                Contacto
            </a>
        </div>

        <div class="flex items-center space-x-4">
            <button class="text-gray-600 hover:text-orange-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
            {{-- Dentro de tu header.blade.php --}}
            <a href="{{ route('carrito.index') }}" class="relative text-gray-600 hover:text-orange-600 p-2">
                {{-- Icono SVG de carrito --}}
                <svg id="cart-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                {{-- Contador (se actualiza por JS) --}}
                <span id="cart-counter" class="absolute -top-1 -right-1 bg-orange-600 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center hidden">
                    0
                </span>
            </a>
            <button class="md:hidden text-gray-600 hover:text-orange-600 focus:outline-none" id="mobile-menu-button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </nav>
    <div class="md:hidden hidden bg-white border-t" id="mobile-menu">
        <a href="#" class="block px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-orange-600 transition duration-300">Hombre</a>
        <a href="#" class="block px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-orange-600 transition duration-300">Mujer</a>
        <a href="#" class="block px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-orange-600 transition duration-300">Niños</a>
        <a href="#" class="block px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-orange-600 transition duration-300">Ofertas</a>
        <a href="#" class="block px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-orange-600 transition duration-300">Novedades</a>
    </div>
</header>