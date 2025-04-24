{{-- resources/views/welcome.blade.php --}}

@extends('layouts.app') 

@section('content') 

    {{-- Sección Hero --}}
    <section class="relative bg-gradient-to-r from-gray-800 to-orange-900 text-white rounded-lg shadow-lg overflow-hidden mb-12">
        <img src="{{ asset('images/hero.jpg') }}" alt="Imagen Hero Deportiva" class="absolute inset-0 w-full h-full object-cover opacity-50" onerror="this.style.display='none'">
        <div class="relative z-10 p-8 md:p-16 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Supera Tus Límites</h1>
            <p class="text-lg md:text-xl mb-8">Encuentra el equipamiento perfecto para alcanzar tus metas.</p>
            <a href="{{ route('tienda.index') }}" class="relative inline-flex items-center px-12 py-5 font-bold text-white transition-all duration-300 bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 rounded-full shadow-xl transform hover:scale-105 hover:shadow-2xl">
                <span class="relative">Ver Productos</span>
            </a>
        </div>
    </section>

    {{-- Sección Novedades --}}
    <section class="mb-16 container mx-auto" >
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center md:text-left">Novedades</h2>
        @if ($novedades->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($novedades as $producto)
                    {{-- Usamos el componente Blade product-card --}}
                    <x-product-card :producto="$producto" /> 
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center md:text-left">Pronto tendremos nuevos productos.</p>
        @endif
    </section>

    {{-- Sección Ofertas --}}
    <section class="mb-16 bg-orange-50 py-12 rounded-lg px-6 container mx-auto">
        <h2 class="text-3xl font-bold text-orange-700 mb-6 text-center">🔥 ¡Ofertas Especiales!</h2>
        @if ($ofertas->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($ofertas as $producto)
                     {{-- Reutilizamos el componente Blade product-card --}}
                    <x-product-card :producto="$producto" />
                @endforeach
            </div>
        @else
            <p class="text-gray-600 text-center">No hay ofertas disponibles en este momento.</p>
        @endif
    </section>

    {{-- Sección Categorías Destacadas (Visual) --}}
    @if ($categoriasInfo->isNotEmpty())
    <section class="mb-16 container mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Explora Nuestras Categorías</h2>
        {{-- Ajusta el número de columnas según cuántas categorías tengas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 {{ $categoriasInfo->count() >= 3 ? 'lg:grid-cols-3' : '' }} gap-6">
            @foreach($categoriasInfo as $categoria)
            <a href="{{ $categoria['url'] }}" class="group block relative rounded-lg overflow-hidden shadow-lg transform hover:-translate-y-1 transition duration-300">
                {{-- TODO: Reemplazar placeholder con imagen real de categoría --}}
                <img src="{{ asset('images/categories/' . $categoria['imagen']) }}" alt="{{ $categoria['nombre'] }}" 
                     class="w-full h-64 object-cover transition duration-500 ease-in-out group-hover:scale-110"
                     onerror="this.src='https://placehold.co/400x300/cccccc/333?text={{ urlencode($categoria['nombre']) }}'; this.alt='{{ $categoria['nombre'] }}';">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 transition duration-300 group-hover:bg-opacity-60">
                    <h3 class="text-white text-2xl font-semibold text-center">{{ $categoria['nombre'] }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Sección Propuesta de Valor --}}
    <section class="mb-16 bg-gray-100 py-12 rounded-lg px-6 container mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">En Angel Viajero</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            {{-- Item 1: Calidad Garantizada (Icono sin cambios) --}}
            <div class="flex flex-col items-center">
                 <svg class="h-12 w-12 text-orange-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                 <h3 class="text-xl font-semibold text-gray-800 mb-2">Calidad Garantizada</h3>
                 <p class="text-gray-600">Seleccionamos los mejores productos para tu rendimiento.</p>
            </div>

            {{-- Item 2: Atención Directa (Icono WhatsApp) --}}
             <div class="flex flex-col items-center">
                 {{-- Icono WhatsApp (Bootstrap Icons) --}}
                 {{-- Se ajusta viewBox a 0 0 16 16 para este path específico --}}
                 <svg class="h-12 w-12 text-orange-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                     <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                 </svg>
                 <h3 class="text-xl font-semibold text-gray-800 mb-2">Atención Directa</h3>
                 <p class="text-gray-600">Resolvemos tus dudas y gestionamos tu pedido por WhatsApp.</p>
            </div>

            {{-- Item 3: Envíos Confiables (Icono Coche Frontal) --}}
             <div class="flex flex-col items-center">
                  {{-- Icono Coche Frontal (Material Design Icons - directions_car) --}}
                  <svg class="h-12 w-12 text-orange-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                  </svg>
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">Envíos Confiables</h3>
                  <p class="text-gray-600">Coordinamos la entrega para que recibas tus productos.</p>
             </div>
        </div>
    </section>

    {{-- Sección Cómo Comprar --}}
    <section class="container mx-auto mb-16">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-8 text-center">Compra por WhatsApp</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            {{-- Paso 1 --}}
            <div class="flex flex-col items-center p-4 bg-gray-50 rounded-lg shadow-sm">
                <div class="bg-orange-600 text-white rounded-full h-12 w-12 flex items-center justify-center text-xl font-bold mb-4">1</div>
                <h4 class="font-semibold text-lg mb-2">Explora y Añade</h4>
                <p class="text-gray-600 text-sm">Navega por nuestros productos y agrégalos a tu carrito.</p>
            </div>
             {{-- Paso 2 --}}
             <div class="flex flex-col items-center p-4 bg-gray-50 rounded-lg shadow-sm">
                <div class="bg-orange-600 text-white rounded-full h-12 w-12 flex items-center justify-center text-xl font-bold mb-4">2</div>
                <h4 class="font-semibold text-lg mb-2">Revisa tu Carrito</h4>
                <p class="text-gray-600 text-sm">Ve al icono del carrito para ver tu selección y cantidades.</p>
            </div>
             {{-- Paso 3 --}}
             <div class="flex flex-col items-center p-4 bg-gray-50 rounded-lg shadow-sm">
                <div class="bg-orange-600 text-white rounded-full h-12 w-12 flex items-center justify-center text-xl font-bold mb-4">3</div>
                <h4 class="font-semibold text-lg mb-2">Envía por WhatsApp</h4>
                <p class="text-gray-600 text-sm">Haz clic en el botón del carrito para enviarnos tu pedido.</p>
            </div>
             {{-- Paso 4 --}}
             <div class="flex flex-col items-center p-4 bg-gray-50 rounded-lg shadow-sm">
                <div class="bg-orange-600 text-white rounded-full h-12 w-12 flex items-center justify-center text-xl font-bold mb-4">4</div>
                <h4 class="font-semibold text-lg mb-2">Coordina y Recibe</h4>
                <p class="text-gray-600 text-sm">Te contactaremos para confirmar pago y detalles de entrega.</p>
            </div>
        </div>
    </section>

    {{-- Sección Ubicaciones de Entrega --}}
    <section class="mb-16 bg-white py-12 rounded-lg px-6 container mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Puntos de Entrega</h2>
        <div class="flex flex-col md:flex-row gap-8 items-center">
            <div class="md:w-1/2">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Entrega Personal en:</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2 mb-6">
                    {{-- TODO: Listar ubicaciones reales --}}
                    <li>Plaza Las Américas, Ecatepec</li>
                    <li>Los Heroes V Seccion</li>
                    <li>Central de Abasto Ecatepec</li>
                    <li>Plaza Aragón</li>
                    <li>Indios Verdes</li>
                    <li>Líneas de metro</li>
                </ul>
                <p class="text-md font-semibold text-orange-600">Contáctanos por WhatsApp para coordinar el punto exacto y horario.</p>
            </div>
            {{-- Contenedor del Iframe (antes era md:w-1/2 directamente sobre la imagen) --}}
            <div class="md:w-1/2 w-full"> {{-- Aseguramos w-full para pantallas pequeñas --}}
                {{-- Wrapper para el aspect ratio --}}
                <div class="relative overflow-hidden rounded-lg shadow-md pt-[75%]"> {{-- pt-[75%] para aspect ratio 4:3 --}}
                    <iframe 
                        src="https://www.google.com/maps/d/u/3/embed?mid=140nBbc9rL7O70mH0G8ke8UPggf4ZAwA&ehbc=2E312F&noprof=1" {{-- Asegúrate que esta URL sea la correcta --}}
                        class="absolute top-0 left-0 w-full h-full border-0" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto mb-16 text-center bg-gradient-to-r from-green-50 to-emerald-50 py-12 px-6 rounded-lg shadow-lg">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-4">¿Tienes Dudas o Consultas?</h2>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
            Si tienes alguna pregunta sobre un producto, el proceso de compra, o cualquier otra cosa, no dudes en enviarnos un mensaje directo por WhatsApp.
        </p>
        @php
            $numeroWhatsApp = '5215638193041'; // Ejemplo: México Celular
            $mensajeWhatsApp = rawurlencode('Hola Angel Viajero, tengo una consulta:'); // Mensaje predefinido
            $urlWhatsApp = "https://wa.me/{$numeroWhatsApp}?text={$mensajeWhatsApp}";
        @endphp
        <a href="{{ $urlWhatsApp }}"
           target="_blank" {{-- Abrir en nueva pestaña --}}
           rel="noopener noreferrer" {{-- Buenas prácticas de seguridad --}}
           class="inline-flex items-center justify-center gap-2 bg-green-500 text-white font-bold py-3 px-8 rounded-full shadow-md hover:bg-green-600 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 16 16"> <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/> </svg>
            <span>Enviar Mensaje por WhatsApp</span>
        </a>
    </section>

    {{-- Sección CTA Final --}}
    <section class="text-center py-12 container mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">¿Listo para Empezar?</h2>
        <p class="text-gray-600 mb-8">Explora todos nuestros productos y encuentra lo que necesitas.</p>
        <a href="{{ route('tienda.index') }}" class="relative inline-flex items-center px-12 py-5 font-bold text-white transition-all duration-300 bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 rounded-full shadow-xl transform hover:scale-105 hover:shadow-2xl">
            <span class="relative">Ver Productos</span>
        </a>
    </section>

@endsection
