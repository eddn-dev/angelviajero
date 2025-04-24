{{-- resources/views/productos/show.blade.php --}}

@extends('layouts.app')

@section('content')
    {{-- Asegurarse que la variable $producto existe --}}
    @isset($producto)
        {{-- Alpine.js: Inicializamos datos --}}
        {{-- Asegúrate que todas las variables usadas en los @click estén aquí --}}
        <main class="container mx-auto px-6 py-12"
              x-data="{
                  // --- Datos pasados desde PHP ---
                  productId: '{{ $producto['id'] }}',
                  productName: @js($producto['nombre']), // Añadido para usar en botones WhatsApp
                  productIsOnSale: {{ $producto['en_oferta'] ? 'true' : 'false' }},
                  productBasePrice: {{ $producto['precio_base'] ?? 0 }},
                  productOfferPrice: {{ $producto['precio_oferta'] ?? 'null' }},
                  variants: {{ Illuminate\Support\Js::from($producto['variantes']) }},
                  mainImageUrl: '{{ asset('images/products/' . $producto['imagen_principal']) }}',

                  // --- Estado de Alpine ---
                  selectedVariantId: '{{ $producto['variantes'][0]['id_variante'] ?? null }}',
                  selectedAttributes: {{ Illuminate\Support\Js::from($producto['variantes'][0]['atributos'] ?? []) }},

                  // --- Propiedades Computadas ---
                  get currentVariant() {
                      // Encuentra el objeto de la variante completa basado en el ID seleccionado
                      return this.variants.find(v => v.id_variante === this.selectedVariantId) || this.variants[0]; // Fallback a la primera variante
                  },

                  get currentPrice() {
                      const variant = this.currentVariant;
                      let priceToShow = this.productBasePrice; // Precio por defecto

                      if (variant && typeof variant.precio !== 'undefined') {
                          priceToShow = parseFloat(variant.precio);
                      }

                      // Si el producto base está en oferta Y tiene un precio de oferta válido, ESE es el precio a mostrar
                      if (this.productIsOnSale && this.productOfferPrice !== null) {
                          priceToShow = this.productOfferPrice;
                      }

                      return !isNaN(priceToShow) ? priceToShow.toFixed(2) : '0.00';
                  },

                  // --- Métodos ---
                  selectVariant(variantId) {
                      this.selectedVariantId = variantId;
                      const variant = this.currentVariant;
                      if (variant) {
                          this.selectedAttributes = variant.atributos;
                          // Opcional: Cambiar imagen principal si la variante tiene una imagen específica
                          // if (variant.imagen) { this.mainImageUrl = ... } else { ... }
                      }
                  },

                  changeMainImage(url) {
                      this.mainImageUrl = url;
                  }
              }"
              x-init="() => {
                  // Lógica inicial si es necesaria
                  console.log('Alpine inicializado para producto:', productId, productName);
                  // Asegurarse de que la variante inicial esté bien seleccionada
                  if (!selectedVariantId && variants.length > 0) {
                      selectVariant(variants[0].id_variante);
                  }
              }">

            <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg">
                <div class="flex flex-col md:flex-row gap-8">

                    {{-- Columna Izquierda: Galería de Imágenes --}}
                    <div class="md:w-1/2">
                        {{-- Imagen Principal --}}
                        <div class="mb-4 aspect-square bg-gray-100 rounded-lg overflow-hidden shadow-md">
                            <img id="main-product-image"
                                 :src="mainImageUrl"
                                 :alt="'Imagen principal de ' + productName"
                                 class="w-full h-full object-cover"
                                 x-cloak
                                 onerror="this.src='https://placehold.co/600x600/e0e0e0/333333?text=Error+Imagen'; this.alt='Error al cargar imagen'">
                        </div>

                        {{-- Miniaturas (Thumbnails) --}}
                        @if(!empty($producto['imagenes_galeria']) || $producto['imagen_principal'])
                            <div class="flex space-x-2 overflow-x-auto pb-2">
                                {{-- Miniatura de la imagen principal --}}
                                @php $mainImgUrl = asset('images/products/' . $producto['imagen_principal']); @endphp
                                <img src="{{ $mainImgUrl }}"
                                     alt="Miniatura principal"
                                     class="w-20 h-20 object-cover rounded-md cursor-pointer border-2 hover:border-orange-500 transition"
                                     :class="{ 'border-orange-500': mainImageUrl === '{{ $mainImgUrl }}', 'border-transparent': mainImageUrl !== '{{ $mainImgUrl }}' }"
                                     @click="changeMainImage('{{ $mainImgUrl }}')">

                                {{-- Miniaturas de la galería --}}
                                @foreach($producto['imagenes_galeria'] as $imgGaleria)
                                    @php $galleryImgUrl = asset('images/products/' . $imgGaleria); @endphp
                                    <img src="{{ $galleryImgUrl }}"
                                         alt="Miniatura {{ $loop->iteration + 1 }}"
                                         class="w-20 h-20 object-cover rounded-md cursor-pointer border-2 border-transparent hover:border-orange-500 transition"
                                         :class="{ 'border-orange-500': mainImageUrl === '{{ $galleryImgUrl }}', 'border-transparent': mainImageUrl !== '{{ $galleryImgUrl }}' }"
                                         @click="changeMainImage('{{ $galleryImgUrl }}')">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Columna Derecha: Detalles y Opciones --}}
                    <div class="md:w-1/2 flex flex-col">
                        {{-- Título del Producto --}}
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">{{ $producto['nombre'] }}</h1>

                        {{-- Categoría --}}
                        <span class="text-sm text-gray-500 mb-4">{{ $producto['categoria'] ?? 'Producto' }}</span>

                        {{-- Precio --}}
                        <div class="mb-6">
                            <span class="text-3xl font-bold text-orange-600">
                                <template x-if="productIsOnSale && productOfferPrice !== null">
                                    <span class="text-gray-500 line-through mr-2 text-2xl">${{ number_format($producto['precio_base'], 2) }}</span>
                                </template>
                                $<span x-text="currentPrice"></span>
                            </span>
                        </div>

                        {{-- Descripción Corta/Larga --}}
                        <p class="text-gray-700 mb-6">
                            {{ $producto['descripcion_larga'] ?? $producto['descripcion_corta'] }}
                        </p>

                        {{-- Selección de Variantes --}}
                        @if(!empty($producto['variantes']) && count($producto['variantes']) > 0)
                            <div class="space-y-4 mb-6">
                                {{-- Generar opciones para TAMAÑO --}}
                                @php
                                    $tallasUnicas = collect($producto['variantes'])->pluck('atributos.tamaño')->filter()->unique()->sort();
                                @endphp
                                @if($tallasUnicas->isNotEmpty())
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Talla:</label>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($tallasUnicas as $talla)
                                            @php
                                                $variantForSize = collect($producto['variantes'])->first(function ($variant) use ($talla) {
                                                    return isset($variant['atributos']['tamaño']) && $variant['atributos']['tamaño'] == $talla;
                                                });
                                                $variantIdForSize = $variantForSize['id_variante'] ?? null;
                                                $stockForSize = $variantForSize['stock'] ?? 0;
                                            @endphp
                                            @if($variantIdForSize)
                                                <button type="button"
                                                        @click="selectVariant('{{ $variantIdForSize }}')"
                                                        :class="{
                                                            'bg-orange-600 text-white border-orange-600': selectedAttributes.tamaño == '{{ $talla }}',
                                                            'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': selectedAttributes.tamaño != '{{ $talla }}',
                                                            'opacity-50 cursor-not-allowed': {{ $stockForSize <= 0 ? 'true' : 'false' }}
                                                        }"
                                                        class="py-2 px-4 border rounded-md text-sm font-medium transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed"
                                                        :disabled="{{ $stockForSize <= 0 ? 'true' : 'false' }}">
                                                    {{ $talla }}
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                {{-- Generar opciones para COLOR --}}
                                @php
                                    $coloresUnicos = collect($producto['variantes'])->pluck('atributos.color')->filter()->unique();
                                @endphp
                                {{-- Mostrar colores si hay más de uno, O si no había tallas para seleccionar --}}
                                @if($coloresUnicos->isNotEmpty() && ($coloresUnicos->count() > 1 || $tallasUnicas->isEmpty()))
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Color:</label>
                                     <div class="flex flex-wrap gap-2">
                                        @foreach($coloresUnicos as $color)
                                             @php
                                                // Encuentra la primera variante que coincida con este color Y la talla seleccionada (si aplica)
                                                $variantForColor = collect($producto['variantes'])->first(function ($variant) use ($color, $tallasUnicas) {
                                                    $colorMatch = isset($variant['atributos']['color']) && $variant['atributos']['color'] == $color;
                                                    // Si hay tallas, la variante también debe coincidir con la talla seleccionada actualmente
                                                    $sizeMatch = !$tallasUnicas->isNotEmpty() || (isset($variant['atributos']['tamaño']) && $variant['atributos']['tamaño'] == $this->selectedAttributes['tamaño']);
                                                    return $colorMatch && $sizeMatch;
                                                });
                                                // Si no se encontró con la talla actual, busca la primera que tenga ese color (fallback)
                                                if (!$variantForColor) {
                                                     $variantForColor = collect($producto['variantes'])->firstWhere('atributos.color', $color);
                                                }
                                                $variantIdForColor = $variantForColor['id_variante'] ?? null;
                                                $stockForColor = $variantForColor['stock'] ?? 0;
                                             @endphp
                                            @if($variantIdForColor)
                                                <button type="button"
                                                        @click="selectVariant('{{ $variantIdForColor }}')"
                                                        :class="{
                                                            'bg-orange-600 text-white border-orange-600': selectedAttributes.color == '{{ $color }}',
                                                            'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': selectedAttributes.color != '{{ $color }}',
                                                            'opacity-50 cursor-not-allowed': {{ $stockForColor <= 0 ? 'true' : 'false' }}
                                                        }"
                                                        class="py-2 px-4 border rounded-md text-sm font-medium transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed"
                                                         :disabled="{{ $stockForColor <= 0 ? 'true' : 'false' }}">
                                                    {{ $color }}
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        @endif

                        {{-- ========================================================== --}}
                        {{-- INICIO: Bloque de Cantidad y Botones de Acción Actualizado --}}
                        {{-- ========================================================== --}}

                        {{-- Selección de Cantidad --}}
                        <div class="mb-6 flex items-center">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mr-3">Cantidad:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1"
                                   class="w-20 border border-gray-300 rounded-md shadow-sm py-2 px-3 text-center focus:outline-none focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        {{-- Bloque de Botones de Acción --}}
                        <div class="mt-auto space-y-4"> {{-- mt-auto empuja esto hacia abajo si hay espacio --}}

                            {{-- 1. Botón Añadir al Carrito --}}
                            <button
                                type="button"
                                class="w-full bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-orange-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 disabled:opacity-50 flex items-center justify-center gap-2"
                                @click="addToCart({
                                    variantId: selectedVariantId,
                                    quantity: parseInt(document.getElementById('quantity').value) || 1,
                                    productId: productId,
                                    productName: productName,
                                    variantAttributes: currentVariant?.atributos || {},
                                    price: parseFloat(currentPrice),
                                    imageUrl: mainImageUrl
                                })"
                                :disabled="!selectedVariantId || (currentVariant?.stock ?? 0) <= 0" >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                  </svg>
                                <span x-text="(currentVariant?.stock ?? 0) > 0 ? 'Añadir al Carrito' : 'Agotado'"></span>
                            </button>

                            {{-- Divisor o Espacio --}}
                            <div class="flex items-center justify-center gap-2 text-sm text-gray-500">
                                <span class="h-px flex-1 bg-gray-200"></span>
                                <span>Ó</span>
                                <span class="h-px flex-1 bg-gray-200"></span>
                            </div>

                            {{-- 2. Nuevos Botones WhatsApp --}}
                            <div class="flex flex-col sm:flex-row gap-3">

                                {{-- Botón Comprar Ahora por WhatsApp --}}
                                <button
                                    type="button"
                                    class="flex-1 bg-green-500 text-white font-semibold py-3 px-4 rounded-lg shadow hover:bg-green-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-60 flex items-center justify-center gap-2"
                                    @click="
                                        const qty = parseInt(document.getElementById('quantity').value) || 1;
                                        const variant = currentVariant;
                                        const attrs = Object.entries(variant?.atributos || {}).map(([k, v]) => `${k.charAt(0).toUpperCase() + k.slice(1)}: ${v}`).join(', ');
                                        const message = `¡Hola Angel Viajero! 👋 Quiero comprar ahora:\n\n* ${qty}x ${productName}${attrs ? ` (${attrs})` : ''}\n\n¡Espero indicaciones para el pago y entrega! 😊`;
                                        const whatsappNumber = '5215638193041'; // <-- ¡¡¡REEMPLAZA CON TU NÚMERO!!!
                                        const url = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
                                        window.open(url, '_blank');
                                    "
                                    :disabled="!selectedVariantId || (currentVariant?.stock ?? 0) <= 0">
                                    {{-- Icono WhatsApp SVG --}}
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                                    <span>Comprar ahora</span>
                                </button>

                                {{-- Botón Más Info por WhatsApp --}}
                                <button
                                    type="button"
                                    class="flex-1 bg-gray-600 text-white font-semibold py-3 px-4 rounded-lg shadow hover:bg-gray-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 flex items-center justify-center gap-2"
                                    @click="
                                        const variant = currentVariant;
                                        const attrs = Object.entries(variant?.atributos || {}).map(([k, v]) => `${k.charAt(0).toUpperCase() + k.slice(1)}: ${v}`).join(', ');
                                        const message = `Hola Angel Viajero 👋, me gustaría más información sobre este producto:\n\n* ${productName}${attrs ? ` (${attrs})` : ''}\n\n¡Gracias!`;
                                        const whatsappNumber = '5215638193041'; // <-- ¡¡¡REEMPLAZA CON TU NÚMERO!!!
                                        const url = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
                                        window.open(url, '_blank');
                                    ">
                                     {{-- Icono WhatsApp SVG --}}
                                     <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                                     <span>Más información</span>
                                </button>
                            </div>

                        </div>

                        {{-- Meta Info (SKU, Disponibilidad) --}}
                        <div class="mt-6 text-sm text-gray-500 space-y-1">
                            <p><span class="font-medium text-gray-700">SKU:</span> <span x-text="currentVariant?.sku_variante || 'N/A'"></span></p>
                            <p><span class="font-medium text-gray-700">Disponibilidad:</span> <span x-text="(currentVariant?.stock ?? 0) > 0 ? 'En Stock' : 'Agotado'"></span></p>
                        </div>

                        {{-- ======================================================== --}}
                        {{-- FIN: Bloque de Cantidad y Botones de Acción Actualizado --}}
                        {{-- ======================================================== --}}

                    </div> {{-- Fin Columna Derecha --}}
                </div> {{-- Fin Flex Contenedor Principal --}}

                {{-- Sección de Detalles Largos / Características --}}
                @if(!empty($producto['caracteristicas_destacadas']))
                    <div class="mt-12 border-t pt-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Detalles del Producto</h2>
                        {{-- Usar prose para formatear listas, etc. Requiere @tailwindcss/typography --}}
                        <div class="prose prose-orange max-w-none text-gray-700">
                            <ul>
                                @foreach($producto['caracteristicas_destacadas'] as $caracteristica)
                                    <li>{{ $caracteristica }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div> {{-- Fin Contenedor Blanco Principal --}}
        </main>

    @else
        {{-- Mensaje si la variable $producto no llegó a la vista --}}
        <div class="container mx-auto px-6 py-12 text-center">
            <h1 class="text-2xl font-semibold text-red-600">Producto no encontrado</h1>
            <p class="text-gray-500 mt-4">Lo sentimos, el producto que buscas no está disponible.</p>
            <a href="{{ route('home') }}" class="mt-6 inline-block bg-orange-600 text-white py-2 px-4 rounded-lg hover:bg-orange-700 transition">Volver al inicio</a>
        </div>
    @endisset
@endsection
