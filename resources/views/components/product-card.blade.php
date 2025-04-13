{{-- resources/views/components/product-card.blade.php --}}
{{-- Este componente recibe una variable $producto --}}
@props(['producto'])

<div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300 flex flex-col group">
    
    {{-- Contenedor para la imagen con aspect ratio --}}
    <div class="aspect-[1/1] overflow-hidden bg-gray-100"> {{-- Usando 1:1 para cuadrado --}}
        <a href="{{ route('producto.show', $producto['id']) }}"> 
            <img src="{{ asset('images/products/' . $producto['imagen_principal']) }}" 
                 alt="{{ $producto['nombre'] }}" 
                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                 onerror="this.src='https://placehold.co/400x300/e0e0e0/333333?text=Error'; this.alt='Error al cargar imagen';"
            />
        </a>
    </div>

    {{-- Contenido de la tarjeta --}}
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="font-semibold text-lg mb-2 flex-grow">
            <a href="{{ route('producto.show', $producto['id']) }}" class="hover:text-orange-600">
                {{ $producto['nombre'] }}
            </a>
        </h3>
        {{-- Opcional: Mostrar descripción corta si existe --}}
        {{-- <p class="text-gray-600 text-sm mb-3">{{ $producto['descripcion_corta'] }}</p> --}}
        
        {{-- Precio --}}
        <span class="text-orange-600 font-bold mb-3 block"> {{-- Añadido block para asegurar espacio --}}
            @if($producto['en_oferta'] && !empty($producto['precio_oferta']))
                <span class="text-gray-500 line-through mr-2">${{ number_format($producto['precio_base'], 2) }}</span>
                ${{ number_format($producto['precio_oferta'], 2) }}
            @else
                ${{ number_format($producto['precio_base'], 2) }}
            @endif
        </span>
        
        {{-- Enlace a Detalles --}}
        <a href="{{ route('producto.show', $producto['id']) }}" 
           class="mt-auto w-full block text-center bg-orange-600 text-white py-2 px-4 rounded-lg hover:bg-orange-700 transition duration-300">
            Ver Detalles
        </a>
    </div>
</div>
