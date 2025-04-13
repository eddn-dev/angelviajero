{{-- resources/views/carrito/index.blade.php --}}

@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8">Tu Carrito de Compras</h1>

    {{-- Mensaje de Carrito Vacío (inicialmente oculto si JS funciona) --}}
    <div id="empty-cart-message" class="hidden text-center py-16 bg-gray-50 rounded-lg shadow">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        <p class="text-xl font-semibold text-gray-700 mb-2">Tu carrito está vacío</p>
        <p class="text-gray-500 mb-6">Parece que aún no has añadido ningún producto.</p>
        <a href="{{ route('home') }}" {{-- O ruta a tu tienda principal --}}
           class="bg-orange-600 text-white font-semibold py-2 px-6 rounded-lg shadow hover:bg-orange-700 transition duration-300">
            Explorar Productos
        </a>
    </div>

    {{-- Contenedor Principal del Carrito (Tabla y Resumen) --}}
    {{-- Ocultamos inicialmente si JS lo va a mostrar, o dejamos visible --}}
    <div id="cart-table" class="hidden"> {{-- JS quitará 'hidden' si hay items --}}
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Columna Izquierda: Tabla de Items --}}
            <div class="lg:w-2/3">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-2 md:px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                <th scope="col" class="py-3 px-2 md:px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                <th scope="col" class="py-3 px-2 md:px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                <th scope="col" class="py-3 px-2 md:px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                <th scope="col" class="py-3 px-2 md:px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Quitar</th>
                            </tr>
                        </thead>
                        {{-- El contenido se insertará aquí por JS --}}
                        <tbody id="cart-items-container" class="bg-white divide-y divide-gray-200">
                            {{-- Ejemplo de cómo se vería una fila (JS la generará) --}}
                            {{--
                            <tr class="border-b">
                                <td class="py-4 px-2 md:px-6">
                                    <div class="flex items-center space-x-3">
                                        <img src="https://placehold.co/64x64/e0e0e0/333?text=Img" alt="Imagen Producto" class="w-16 h-16 object-cover rounded-md hidden sm:block">
                                        <div>
                                            <p class="font-semibold text-gray-800">Nombre del Producto</p>
                                            <p class="text-sm text-gray-500">Talla: M, Color: Azul</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-2 md:px-6 text-center">$99.99</td>
                                <td class="py-4 px-2 md:px-6">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="text-orange-600 hover:text-orange-800"><svg>...</svg></button>
                                        <span class="font-medium">1</span>
                                        <button class="text-orange-600 hover:text-orange-800"><svg>...</svg></button>
                                    </div>
                                </td>
                                <td class="py-4 px-2 md:px-6 text-center font-semibold">$99.99</td>
                                <td class="py-4 px-2 md:px-6 text-center">
                                    <button class="text-red-500 hover:text-red-700"><svg>...</svg></button>
                                </td>
                            </tr>
                            --}}
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Columna Derecha: Resumen del Pedido --}}
            <div class="lg:w-1/3">
                <div class="bg-white shadow-md rounded-lg p-6 sticky top-24"> {{-- sticky top para que se quede visible al hacer scroll --}}
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 border-b pb-4">Resumen del Pedido</h2>
                    {{-- Puedes añadir aquí costos de envío si los tuvieras --}}
                    {{-- <div class="flex justify-between text-gray-600 mb-2">
                        <span>Subtotal</span>
                        <span>$XXX.XX</span>
                    </div>
                    <div class="flex justify-between text-gray-600 mb-4">
                        <span>Envío</span>
                        <span>$YY.YY</span>
                    </div> --}}
                    <div class="flex justify-between items-center text-gray-800 font-bold text-xl mb-6 pt-4 border-t">
                        <span>Total</span>
                        <span>$<span id="cart-total">0.00</span></span> {{-- El total se inserta aquí --}}
                    </div>

                    <button id="whatsapp-checkout-button"
                            class="w-full bg-green-500 text-white font-bold py-3 px-4 rounded-lg shadow hover:bg-green-600 transition duration-300 flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 16 16"> <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/> </svg>
                        <span>Pedir por WhatsApp</span>
                    </button>

                    <p class="text-xs text-gray-500 mt-4 text-center">Al hacer clic, se abrirá WhatsApp con tu pedido listo para enviar.</p>
                </div>
            </div>

        </div>
    </div> {{-- Fin de cart-table --}}

</main>
@endsection

<a href="{{ route('carrito.index') }}" class="relative text-gray-600 hover:text-orange-600">
    <svg id="cart-icon" ...>...</svg>
    <span id="cart-counter" class="absolute -top-1 -right-1 bg-orange-600 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center hidden">
        0
    </span>
</a>
