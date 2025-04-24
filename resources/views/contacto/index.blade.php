{{-- resources/views/contacto/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Contacto y Puntos de Entrega - Angel Viajero')

@section('content')
<main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-10 text-center border-b pb-4">Contacto y Ubicaciones</h1>
    {{-- Sección CTA WhatsApp General --}}
    <section class="mb-16 text-center bg-gradient-to-r from-green-50 to-emerald-50 py-12 px-6 rounded-lg shadow-lg">
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
    {{-- Sección Cómo Comprar (Clonada de welcome.blade.php) --}}
    <section class="mb-16">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-8 text-center">¿Cómo Comprar por WhatsApp?</h2>
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
    <section class="mb-16 bg-gray-100 py-12 rounded-lg px-6">
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
                <p class="text-sm text-gray-600">Contáctanos por WhatsApp para coordinar el punto exacto y horario.</p>
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

    {{-- Sección CTA Final --}}
    <section class="text-center py-12">
         <h2 class="text-3xl font-bold text-gray-800 mb-4">¿Listo para Empezar?</h2>
         <p class="text-gray-600 mb-8">Explora todos nuestros productos y encuentra lo que necesitas.</p>
         <a href="{{-- route('tienda.index') --}}" class="bg-orange-600 text-white font-semibold py-3 px-10 rounded-full hover:bg-orange-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
             Ir a la Tienda
         </a>
    </section>

</main>
@endsection
