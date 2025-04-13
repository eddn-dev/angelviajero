{{-- resources/views/welcome.blade.php --}}

@extends('layouts.app') {{-- Usa el layout principal --}}

@section('content') {{-- Define el contenido para esta página --}}

<main class="container mx-auto px-6 py-8">

<section class="relative bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg shadow-lg overflow-hidden mb-12">
    <img src="https://placehold.co/1200x500/cccccc/ffffff?text=Imagen+Hero+Deportiva" alt="Imagen Hero Deportiva" class="absolute inset-0 w-full h-full object-cover opacity-30" onerror="this.src='https://placehold.co/1200x500/cccccc/ffffff?text=Error+al+cargar+imagen'; this.alt='Error al cargar imagen'">
    <div class="relative z-10 p-8 md:p-16 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Supera Tus Límites</h1>
        <p class="text-lg md:text-xl mb-8">Encuentra el equipamiento perfecto para alcanzar tus metas.</p>
        <a href="#" class="bg-white text-orange-600 font-semibold py-3 px-8 rounded-full hover:bg-gray-100 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">Descubre Más</a>
    </div>
</section>

<section class="mb-12">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Novedades</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
            <img src="https://placehold.co/400x300/e0e0e0/333333?text=Producto+1" alt="Producto 1" class="w-full h-48 object-cover" onerror="this.src='https://placehold.co/400x300/e0e0e0/333333?text=Error+Imagen'; this.alt='Error Imagen'">
            <div class="p-4">
                <h3 class="font-semibold text-lg mb-2">Zapatillas Running Pro</h3>
                <p class="text-gray-600 text-sm mb-3">Comodidad y rendimiento superior.</p>
                <span class="text-orange-600 font-bold">$120.00</span>
                <button class="mt-3 w-full bg-orange-600 text-white py-2 px-4 rounded-lg hover:bg-orange-700 transition duration-300">Añadir al Carrito</button>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
             <img src="https://placehold.co/400x300/d0d0d0/333333?text=Producto+2" alt="Producto 2" class="w-full h-48 object-cover" onerror="this.src='https://placehold.co/400x300/d0d0d0/333333?text=Error+Imagen'; this.alt='Error Imagen'">
            <div class="p-4">
                <h3 class="font-semibold text-lg mb-2">Camiseta Técnica DryFit</h3>
                <p class="text-gray-600 text-sm mb-3">Mantente seco y fresco.</p>
                <span class="text-orange-600 font-bold">$45.00</span>
                 <button class="mt-3 w-full bg-orange-600 text-white py-2 px-4 rounded-lg hover:bg-orange-700 transition duration-300">Añadir al Carrito</button>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
             <img src="https://placehold.co/400x300/c0c0c0/333333?text=Producto+3" alt="Producto 3" class="w-full h-48 object-cover" onerror="this.src='https://placehold.co/400x300/c0c0c0/333333?text=Error+Imagen'; this.alt='Error Imagen'">
            <div class="p-4">
                <h3 class="font-semibold text-lg mb-2">Shorts Deportivos Flex</h3>
                <p class="text-gray-600 text-sm mb-3">Libertad de movimiento total.</p>
                <span class="text-orange-600 font-bold">$55.00</span>
                 <button class="mt-3 w-full bg-orange-600 text-white py-2 px-4 rounded-lg hover:bg-orange-700 transition duration-300">Añadir al Carrito</button>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
             <img src="https://placehold.co/400x300/b0b0b0/333333?text=Producto+4" alt="Producto 4" class="w-full h-48 object-cover" onerror="this.src='https://placehold.co/400x300/b0b0b0/333333?text=Error+Imagen'; this.alt='Error Imagen'">
            <div class="p-4">
                <h3 class="font-semibold text-lg mb-2">Sudadera con Capucha</h3>
                <p class="text-gray-600 text-sm mb-3">Calidez y estilo urbano.</p>
                <span class="text-orange-600 font-bold">$70.00</span>
                 <button class="mt-3 w-full bg-orange-600 text-white py-2 px-4 rounded-lg hover:bg-orange-700 transition duration-300">Añadir al Carrito</button>
            </div>
        </div>
    </div>
</section>

<section class="mb-12">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Explora por Deporte</h2>
    <div class="relative">
        <div class="flex space-x-6 overflow-x-auto pb-4 hide-scrollbar">
            <a href="#" class="flex-shrink-0 w-64 group">
                <div class="relative rounded-lg overflow-hidden shadow-md">
                    <img src="https://placehold.co/400x500/99ccff/003366?text=Fútbol" alt="Fútbol" class="w-full h-80 object-cover transition duration-500 ease-in-out transform group-hover:scale-110" onerror="this.src='https://placehold.co/400x500/99ccff/003366?text=Error+Imagen'; this.alt='Error Imagen'">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-4">
                        <h3 class="text-white text-2xl font-semibold">Fútbol</h3>
                    </div>
                </div>
            </a>
            <a href="#" class="flex-shrink-0 w-64 group">
                <div class="relative rounded-lg overflow-hidden shadow-md">
                    <img src="https://placehold.co/400x500/ffcc99/993300?text=Baloncesto" alt="Baloncesto" class="w-full h-80 object-cover transition duration-500 ease-in-out transform group-hover:scale-110" onerror="this.src='https://placehold.co/400x500/ffcc99/993300?text=Error+Imagen'; this.alt='Error Imagen'">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-4">
                        <h3 class="text-white text-2xl font-semibold">Baloncesto</h3>
                    </div>
                </div>
            </a>
            <a href="#" class="flex-shrink-0 w-64 group">
                 <div class="relative rounded-lg overflow-hidden shadow-md">
                    <img src="https://placehold.co/400x500/ccffcc/006600?text=Running" alt="Running" class="w-full h-80 object-cover transition duration-500 ease-in-out transform group-hover:scale-110" onerror="this.src='https://placehold.co/400x500/ccffcc/006600?text=Error+Imagen'; this.alt='Error Imagen'">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-4">
                        <h3 class="text-white text-2xl font-semibold">Running</h3>
                    </div>
                </div>
            </a>
            <a href="#" class="flex-shrink-0 w-64 group">
                <div class="relative rounded-lg overflow-hidden shadow-md">
                    <img src="https://placehold.co/400x500/ffff99/666600?text=Tenis" alt="Tenis" class="w-full h-80 object-cover transition duration-500 ease-in-out transform group-hover:scale-110" onerror="this.src='https://placehold.co/400x500/ffff99/666600?text=Error+Imagen'; this.alt='Error Imagen'">
                     <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-4">
                        <h3 class="text-white text-2xl font-semibold">Tenis</h3>
                    </div>
                </div>
            </a>
             <a href="#" class="flex-shrink-0 w-64 group">
                <div class="relative rounded-lg overflow-hidden shadow-md">
                    <img src="https://placehold.co/400x500/ffcccc/990000?text=Gimnasio" alt="Gimnasio" class="w-full h-80 object-cover transition duration-500 ease-in-out transform group-hover:scale-110" onerror="this.src='https://placehold.co/400x500/ffcccc/990000?text=Error+Imagen'; this.alt='Error Imagen'">
                     <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-4">
                        <h3 class="text-white text-2xl font-semibold">Gimnasio</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

</main>

@endsection

