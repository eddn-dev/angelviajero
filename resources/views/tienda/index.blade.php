{{-- resources/views/tienda/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Tienda - Angel Viajero') {{-- Opcional: Título específico para la página --}}

@section('content')
<main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-10 text-center border-b pb-4">Nuestros Productos</h1>

    @if($productosPorCategoria->isEmpty())
        {{-- Mensaje si no hay productos o categorías --}}
        <div class="text-center py-16 bg-gray-50 rounded-lg shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            <p class="text-xl font-semibold text-gray-700 mb-2">¡Próximamente!</p>
            <p class="text-gray-500">Aún no tenemos productos disponibles en la tienda.</p>
        </div>
    @else
        {{-- Iterar sobre cada categoría --}}
        @foreach($productosPorCategoria as $categoria => $productos)
            <section class="mb-16">
                {{-- Título de la Categoría --}}
                <h2 class="text-2xl md:text-3xl font-semibold text-orange-700 mb-6 capitalize">{{ $categoria }}</h2>

                {{-- Grid Responsivo para los Productos de esta Categoría --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 lg:gap-8">
                    {{-- Iterar sobre los productos de la categoría actual --}}
                    @foreach($productos as $producto)
                        {{-- Reutilizar el componente de tarjeta de producto --}}
                        {{-- Asegúrate que tu componente x-product-card esté bien estilizado --}}
                        <x-product-card :producto="$producto" />
                    @endforeach
                </div>
            </section>
        @endforeach
    @endif

</main>
@endsection
