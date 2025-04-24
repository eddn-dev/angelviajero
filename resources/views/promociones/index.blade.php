{{-- resources/views/promociones/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Promociones - Angel Viajero')

@section('content')
{{-- Inicialización de Alpine.js para el modal --}}
<div x-data="{ openModal: false, modalTitle: '', modalConditions: [] }" class="container mx-auto px-0 sm:px-4 lg:px-8 py-12">

    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-10 text-center px-4 border-b pb-4">Promociones Especiales</h1>

    @if($promociones->isEmpty())
        <div class="text-center py-16 bg-gray-50 rounded-lg shadow mx-4">
            <p class="text-xl font-semibold text-gray-700 mb-2">¡Vuelve Pronto!</p>
            <p class="text-gray-500">Actualmente no tenemos promociones activas, pero estamos preparando sorpresas.</p>
        </div>
    @else
        <div class="space-y-8 md:space-y-12">
            {{-- Iterar sobre cada promoción --}}
            @foreach($promociones as $promocion)
                @php
                    // Reintroducimos la lógica de alternancia basada en el índice del loop
                    $isOdd = $loop->odd; // Impar: Texto Izquierda | Par: Texto Derecha

                    // Clases para el Contenedor del Texto
                    $contentMarginClass = $isOdd ? 'mr-auto' : 'ml-auto'; // Empuja el bloque a izq/der
                    $textAlignClass = $isOdd ? 'lg:text-left' : 'lg:text-right'; // Alineación del texto interno
                    $buttonJustifyClass = $isOdd ? 'sm:justify-start' : 'sm:justify-end'; // Alineación de botones internos

                    // Clases para el Fondo y Gradiente
                    // Si texto está a la izquierda (impar), centrar imagen a la derecha en LG.
                    // Si texto está a la derecha (par), centrar imagen a la izquierda en LG.
                    $bgPositionClass = $isOdd ? 'lg:bg-right' : 'lg:bg-left';
                    // Si texto está a la izquierda (impar), gradiente oscurece derecha (va hacia la izquierda).
                    // Si texto está a la derecha (par), gradiente oscurece izquierda (va hacia la derecha).
                    $gradientClass = $isOdd
                        ? 'bg-gradient-to-r from-black/70 via-black/60 to-black-10' // Texto Izq -> Gradiente Der
                        : 'bg-gradient-to-l from-black/70 via-black/60 to-black-10'; // Texto Der -> Gradiente Izq

                    // Path de la imagen
                    $imagePath = asset($promocion['imagen_fondo'] ?? 'https://placehold.co/1200x400/cccccc/333?text=Promo'); // Fallback
                @endphp

                {{-- Sección de Promoción Individual --}}
                {{-- Aplicamos la posición de fondo condicional --}}
                <section class="relative min-h-[300px] md:min-h-[350px] lg:min-h-[400px] bg-cover bg-center {{ $bgPositionClass }} bg-no-repeat rounded-lg overflow-hidden shadow-lg mx-4 sm:mx-0 flex items-center"
                         style="background-image: url('{{ $imagePath }}')">

                    {{-- Capa de Superposición con Gradiente Condicional --}}
                    <div class="absolute inset-0 {{ $gradientClass }} z-0"></div>

                    {{-- Contenedor del Contenido (Posición y Alineación Condicional) --}}
                    {{-- Usamos el margen condicional para empujar el bloque --}}
                    <div class="relative z-10 w-full lg:w-1/2 p-6 md:p-10 {{ $contentMarginClass }} flex"> {{-- Flex para que justify funcione abajo --}}
                        {{-- Aplicamos alineación de texto condicional --}}
                        <div class="w-full max-w-md text-white {{ $textAlignClass }}"> {{-- w-full para ocupar el contenedor padre --}}
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 drop-shadow-md">
                                {{ $promocion['titulo'] ?? 'Promoción Especial' }}
                            </h2>
                            <p class="text-base sm:text-lg mb-6 drop-shadow">
                                {{ $promocion['descripcion'] ?? '' }}
                            </p>
                            {{-- Aplicamos justificación de botones condicional --}}
                            <div class="flex flex-col sm:flex-row gap-3 {{ $buttonJustifyClass }} items-center">
                                {{-- Botón CTA Principal --}}
                                <a href="{{ $promocion['cta_enlace'] ?? '#' }}"
                                   class="relative inline-flex items-center px-12 py-5 font-bold text-white transition-all duration-300 bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 rounded-full shadow-xl transform hover:scale-105 hover:shadow-2xl">
                                    {{ $promocion['cta_texto'] ?? 'Ver Más' }}
                                </a>
                                {{-- Botón para ver condiciones (abre modal) --}}
                                @if(!empty($promocion['condiciones']) && is_array($promocion['condiciones']))
                                    <button
                                        @click="
                                            openModal = true;
                                            modalTitle = @js($promocion['titulo'] ?? 'Condiciones');
                                            modalConditions = @js($promocion['condiciones']);
                                        "
                                        class="inline-flex items-center justify-center bg-gray-200 bg-opacity-80 hover:bg-opacity-100 text-gray-800 font-semibold py-2 px-4 rounded-full shadow transition duration-300 text-sm whitespace-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Condiciones
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    @endif

    {{-- Modal para Condiciones (sin cambios) --}}
    <div x-show="openModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-50"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 z-40 flex items-center justify-center p-4"
         style="display: none;"
         @click.self="openModal = false"
         @keydown.escape.window="openModal = false"
         x-cloak
         >
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[80vh] overflow-y-auto p-6" @click.stop>
            {{-- Título del Modal --}}
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-xl font-semibold text-gray-800" x-text="modalTitle"></h3>
                <button @click="openModal = false" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            {{-- Contenido del Modal (Lista de Condiciones) --}}
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                <template x-for="(condition, index) in modalConditions" :key="index">
                    <li x-text="condition"></li>
                </template>
            </ul>
            {{-- Botón Cerrar Inferior (Opcional) --}}
            <div class="text-right mt-6 border-t pt-4">
                 <button @click="openModal = false" class="bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300">
                     Cerrar
                 </button>
            </div>
        </div>
    </div>

</div> {{-- Fin del div x-data de Alpine --}}
@endsection