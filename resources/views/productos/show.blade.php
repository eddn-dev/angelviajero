{{-- resources/views/productos/show.blade.php --}}

@extends('layouts.app')

@section('content')
    {{-- Asegurarse que la variable $producto existe --}}
    @isset($producto)
        {{-- Alpine.js: Inicializamos datos --}}
        <main class="container mx-auto px-6 py-12" 
              x-data="{ 
                  // --- Datos pasados desde PHP ---
                  productId: '{{ $producto['id'] }}',
                  productIsOnSale: {{ $producto['en_oferta'] ? 'true' : 'false' }}, // Pasar como booleano JS
                  productBasePrice: {{ $producto['precio_base'] ?? 0 }},           // Pasar como número
                  productOfferPrice: {{ $producto['precio_oferta'] ?? 'null' }},    // Pasar como número o null JS
                  variants: {{ Illuminate\Support\Js::from($producto['variantes']) }}, // Usar Js::from para pasar el array de variantes de forma segura
                  mainImageUrl: '{{ asset('images/products/' . $producto['imagen_principal']) }}',
                  
                  // --- Estado de Alpine ---
                  selectedVariantId: '{{ $producto['variantes'][0]['id_variante'] ?? null }}', 
                  selectedAttributes: {{ Illuminate\Support\Js::from($producto['variantes'][0]['atributos'] ?? []) }}, // Atributos de la variante inicial

                  // --- Propiedades Computadas ---
                  get currentVariant() {
                      // Encuentra el objeto de la variante completa basado en el ID seleccionado
                      return this.variants.find(v => v.id_variante === this.selectedVariantId) || this.variants[0]; // Fallback a la primera variante
                  },

                  get currentPrice() {
                      const variant = this.currentVariant;
                      let priceToShow = this.productBasePrice; // Precio por defecto si algo falla

                      if (variant && typeof variant.precio !== 'undefined') {
                          // Si hay variante seleccionada, su precio es la base (a menos que haya oferta general)
                          priceToShow = parseFloat(variant.precio);
                      }

                      // *** LÓGICA CORREGIDA ***
                      // Si el producto base está en oferta Y tiene un precio de oferta válido, ESE es el precio a mostrar
                      if (this.productIsOnSale && this.productOfferPrice !== null) {
                          priceToShow = this.productOfferPrice;
                      }
                      // Si no está en oferta general, ya tenemos el precio de la variante en priceToShow

                      // Formatear a 2 decimales para mostrar
                      return !isNaN(priceToShow) ? priceToShow.toFixed(2) : '0.00'; 
                  },

                  // --- Métodos ---
                  selectVariant(variantId) {
                      this.selectedVariantId = variantId;
                      const variant = this.currentVariant;
                      if (variant) {
                          this.selectedAttributes = variant.atributos;
                          // Opcional: Cambiar imagen principal si la variante tiene una imagen específica
                          // if (variant.imagen) {
                          //     this.mainImageUrl = '{{ asset('images/products/') }}/' + variant.imagen;
                          // } else {
                          //     // Volver a la principal si la variante no tiene imagen propia
                          //     this.mainImageUrl = '{{ asset('images/products/' . $producto['imagen_principal']) }}';
                          // }
                      }
                  },

                  changeMainImage(url) {
                      this.mainImageUrl = url;
                  }
              }"
              x-init="() => { 
                  // Lógica inicial si es necesaria al cargar el componente Alpine
                  console.log('Alpine inicializado para producto:', productId);
                  // console.log('Variantes:', variants); // Debug
                  // Asegurarse de que la variante inicial esté bien seleccionada
                  if (!selectedVariantId && variants.length > 0) {
                      selectVariant(variants[0].id_variante);
                  }
              }">

            <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg">
                <div class="flex flex-col md:flex-row gap-8">

                    {{-- Columna Izquierda: Galería de Imágenes --}}
                    <div class="md:w-1/2">
                        {{-- Contenedor de Imagen Principal con Aspect Ratio --}}
                        {{-- Usamos aspect-square (1:1). Cambia si necesitas otro aspect ratio --}}
                        {{-- Añadimos un fondo gris claro por si la imagen tarda o falla --}}
                        <div class="mb-4 aspect-square bg-gray-100 rounded-lg overflow-hidden shadow-md"> 
                            <img id="main-product-image" 
                                 :src="mainImageUrl" 
                                 :alt="'Imagen principal de ' + '{{ $producto['nombre'] }}'" 
                                 {{-- Clase cambiada: w-full h-full para llenar el contenedor --}}
                                 class="w-full h-full object-cover" 
                                 {{-- x-cloak para ocultar hasta que Alpine esté listo --}}
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
                                     {{-- La clase activa se maneja con Alpine --}}
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
                    {{-- ... (Resto del código de la columna derecha sin cambios) ... --}}
                     <div class="md:w-1/2 flex flex-col">
                         {{-- Título del Producto --}}
                         <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">{{ $producto['nombre'] }}</h1>
                         
                         {{-- Categoría (o 'breadcrumbs' simples) --}}
                         <span class="text-sm text-gray-500 mb-4">{{ $producto['categoria'] ?? 'Producto' }}</span>

                         {{-- Precio (Dinámico con Alpine.js) --}}
                         <div class="mb-6">
                             <span class="text-3xl font-bold text-orange-600">
                                 <template x-if="productIsOnSale && productOfferPrice !== null">
                                     <span class="text-gray-500 line-through mr-2 text-2xl">${{ number_format($producto['precio_base'], 2) }}</span>
                                 </template>
                                 $<span x-text="currentPrice"></span> 
                             </span>
                         </div>

                         {{-- Descripción --}}
                         <p class="text-gray-700 mb-6">
                             {{ $producto['descripcion_larga'] ?? $producto['descripcion_corta'] }}
                         </p>

                         {{-- Selección de Variantes --}}
                         @if(!empty($producto['variantes']) && count($producto['variantes']) > 0)
                             <div class="grid grid-cols-1 {{-- sm:grid-cols-2 --}} gap-4 mb-6"> 
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
                                                 $variantIdForSize = collect($producto['variantes'])->firstWhere('atributos.tamaño', $talla)['id_variante'] ?? null;
                                             @endphp
                                             @if($variantIdForSize)
                                                 <button type="button"
                                                         @click="selectVariant('{{ $variantIdForSize }}')"
                                                         :class="{ 
                                                             'bg-orange-600 text-white border-orange-600': selectedAttributes.tamaño == '{{ $talla }}', 
                                                             'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': selectedAttributes.tamaño != '{{ $talla }}' 
                                                         }"
                                                         class="py-2 px-4 border rounded-md text-sm font-medium transition duration-150 ease-in-out">
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
                                 @if($coloresUnicos->isNotEmpty() && ($coloresUnicos->count() > 1 || $tallasUnicas->isEmpty())) 
                                 <div class="mt-4"> 
                                     <label class="block text-sm font-medium text-gray-700 mb-1">Color:</label>
                                      <div class="flex flex-wrap gap-2">
                                         @foreach($coloresUnicos as $color)
                                              @php 
                                                 $variantIdForColor = collect($producto['variantes'])->firstWhere('atributos.color', $color)['id_variante'] ?? null;
                                             @endphp
                                             @if($variantIdForColor)
                                                 <button type="button"
                                                         @click="selectVariant('{{ $variantIdForColor }}')"
                                                         :class="{ 
                                                             'bg-orange-600 text-white border-orange-600': selectedAttributes.color == '{{ $color }}', 
                                                             'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': selectedAttributes.color != '{{ $color }}' 
                                                         }"
                                                         class="py-2 px-4 border rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                                     {{ $color }}
                                                 </button>
                                             @endif
                                         @endforeach
                                     </div>
                                 </div>
                                 @endif
                             </div>
                         @endif

                         {{-- Selección de Cantidad --}}
                         <div class="mb-8 flex items-center">
                             <label for="quantity" class="block text-sm font-medium text-gray-700 mr-3">Cantidad:</label>
                             <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-16 border border-gray-300 rounded-md shadow-sm py-2 px-3 text-center focus:outline-none focus:ring-orange-500 focus:border-orange-500">
                         </div>

                         {{-- Botón Añadir al Carrito --}}
                         <div class="mt-auto"> 
                             <button 
                                 type="button" 
                                 class="w-full bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-orange-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 disabled:opacity-50"
                                 @click="addToCart({
                                        variantId: selectedVariantId,
                                        quantity: parseInt(document.getElementById('quantity').value) || 1,
                                        productId: productId,
                                        productName: '{{ $producto['nombre'] }}',
                                        variantAttributes: currentVariant?.atributos || {},
                                        price: parseFloat(currentPrice),
                                        imageUrl: mainImageUrl
                                    })"
                                 :disabled="!selectedVariantId" > 
                                 Añadir al Carrito
                             </button>
                         </div>

                         {{-- Meta Info (Dinámica con Alpine.js) --}}
                         <div class="mt-6 text-sm text-gray-500 space-y-1">
                             <p><span class="font-medium text-gray-700">SKU:</span> <span x-text="currentVariant?.sku_variante || 'N/A'"></span></p>
                             <p><span class="font-medium text-gray-700">Disponibilidad:</span> <span x-text="(currentVariant?.stock ?? 0) > 0 ? 'En Stock' : 'Agotado'"></span></p>
                         </div>
                     </div>
                </div>

                {{-- Sección de Detalles Largos / Características --}}
                {{-- ... (resto igual) ... --}}
                @if(!empty($producto['caracteristicas_destacadas']))
                    <div class="mt-12 border-t pt-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Detalles del Producto</h2>
                        <div class="prose max-w-none text-gray-700"> 
                            <ul>
                                @foreach($producto['caracteristicas_destacadas'] as $caracteristica)
                                    <li>{{ $caracteristica }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div> 
        </main>

        {{-- ... (Scripts y @else / @endisset) ... --}}
        {{-- Script para la función addToCart (Incluir en resources/js/app.js o aquí) --}}
        <script>
            function addToCart(variantId, quantity) {
                if (!variantId) {
                    alert('Por favor, selecciona una variante válida.');
                    return;
                }
                const qty = parseInt(quantity) || 1;
                console.log(`Añadir al carrito: Variante ID=${variantId}, Cantidad=${qty}`);
                
                let cart = JSON.parse(localStorage.getItem('shoppingCart') || '{}'); 
                cart[variantId] = (cart[variantId] || 0) + qty; 
                localStorage.setItem('shoppingCart', JSON.stringify(cart));
                
                alert('Producto añadido al carrito!'); 
                // window.dispatchEvent(new CustomEvent('cart-updated', { detail: { cart: cart } }));
            }
            window.addToCart = addToCart; 
        </script>

    @else
        {{-- Mensaje si la variable $producto no llegó a la vista --}}
        <div class="container mx-auto px-6 py-12 text-center">
            <h1 class="text-2xl font-semibold text-red-600">Producto no encontrado</h1>
            <p class="text-gray-500 mt-4">Lo sentimos, el producto que buscas no está disponible.</p>
            <a href="{{ route('home') }}" class="mt-6 inline-block bg-orange-600 text-white py-2 px-4 rounded-lg hover:bg-orange-700 transition">Volver al inicio</a>
        </div>
    @endisset
@endsection

{{-- Recordatorio: @tailwindcss/typography --}}
