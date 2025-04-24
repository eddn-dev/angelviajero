// resources/js/app.js

import './bootstrap';

// --- Añadir Alpine.js ---
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
// --- Fin Añadir Alpine.js ---

/**
 * Obtiene el carrito de compras desde localStorage.
 * El carrito es un array de objetos, cada uno representando un item.
 * Ejemplo de item: { variantId: 'prod_001_sz7', quantity: 2, productId: 'prod_001', productName: 'Balón Molten', variantAttributes: { tamaño: '7', color: 'Naranja' }, price: 599.00, imageUrl: '...' }
 * @returns {Array<Object>} El array del carrito.
 */
function getCart() {
  const cartData = localStorage.getItem('shoppingCart');
  let cart = []; // Valor por defecto: array vacío

  if (cartData) {
      try {
          const parsedData = JSON.parse(cartData);
          // MUY IMPORTANTE: Verificar si lo parseado es realmente un array
          if (Array.isArray(parsedData)) {
              cart = parsedData; // Es un array válido, lo usamos
          } else {
              // Si no es un array, los datos son inválidos para la nueva lógica
              console.error('Los datos del carrito en localStorage no son un array. Reiniciando carrito.', parsedData);
              localStorage.removeItem('shoppingCart'); // Limpiar los datos inválidos
              // cart ya es [] por defecto
          }
      } catch (error) {
          // Error al parsear el JSON (datos corruptos)
          console.error('Error al parsear los datos del carrito desde localStorage. Reiniciando carrito.', error);
          localStorage.removeItem('shoppingCart'); // Limpiar los datos inválidos
          // cart ya es [] por defecto
      }
  }
  // Siempre devolver un array
  return cart;
}

/**
 * Guarda el carrito de compras en localStorage.
 * @param {Array<Object>} cart El array del carrito a guardar.
 */
function saveCart(cart) {
    localStorage.setItem('shoppingCart', JSON.stringify(cart));
    // Disparar evento para que otras partes de la UI puedan reaccionar (ej. contador del header)
    window.dispatchEvent(new CustomEvent('cart-updated', { detail: { cartCount: getCartItemCount() } }));
}

/**
 * Calcula el número total de items en el carrito (sumando cantidades).
 * @returns {number} El número total de items.
 */
function getCartItemCount() {
    const cart = getCart();
    return cart.reduce((total, item) => total + item.quantity, 0);
}


/**
 * Añade un item al carrito o actualiza su cantidad si ya existe.
 * @param {Object} itemToAdd - El objeto del item a añadir.
 * @param {string} itemToAdd.variantId - ID de la variante.
 * @param {number} itemToAdd.quantity - Cantidad a añadir.
 * @param {string} itemToAdd.productId - ID del producto base.
 * @param {string} itemToAdd.productName - Nombre del producto.
 * @param {Object} itemToAdd.variantAttributes - Atributos de la variante (ej. { tamaño: '7', color: 'Naranja' }).
 * @param {number} itemToAdd.price - Precio unitario de la variante.
 * @param {string} itemToAdd.imageUrl - URL de la imagen a mostrar.
 */
window.addToCart = function(itemToAdd) {
    if (!itemToAdd || !itemToAdd.variantId || itemToAdd.quantity <= 0) {
        console.error('Intento de añadir item inválido:', itemToAdd);
        alert('Error al añadir el producto. Por favor, inténtalo de nuevo.');
        return;
    }

    let cart = getCart();
    const existingItemIndex = cart.findIndex(item => item.variantId === itemToAdd.variantId);

    if (existingItemIndex > -1) {
        // Item ya existe, actualizar cantidad
        cart[existingItemIndex].quantity += itemToAdd.quantity;
    } else {
        // Item nuevo, añadirlo al carrito
        cart.push(itemToAdd);
    }

    saveCart(cart);

    // --- Feedback Visual ---
    // 1. Mostrar un mensaje de confirmación más elegante (ej. usando una librería o un div temporal)
    showToast('Producto añadido al carrito!');

    // 2. Opcional: Animar el icono del carrito en el header
    const cartIcon = document.getElementById('cart-icon'); // Asegúrate que tu icono tenga este ID
    if (cartIcon) {
        cartIcon.classList.add('animate-bounce'); // Añade una clase de animación Tailwind
        setTimeout(() => {
            cartIcon.classList.remove('animate-bounce');
        }, 1000); // Quita la animación después de 1 segundo
    }

    console.log('Carrito actualizado:', getCart());
    updateCartCounter(); // Actualiza el contador del header inmediatamente
}

/**
 * Muestra un mensaje temporal (toast) en la pantalla.
 * @param {string} message - El mensaje a mostrar.
 */
function showToast(message) {
    const toast = document.createElement('div');
    toast.textContent = message;
    // Estilos básicos (puedes mejorarlos con Tailwind)
    toast.className = 'fixed bottom-5 right-5 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg transition-opacity duration-300 z-50';
    document.body.appendChild(toast);

    // Hacer que aparezca
    setTimeout(() => {
        toast.style.opacity = '1';
    }, 10);

    // Hacer que desaparezca después de 3 segundos
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300); // Espera a que termine la transición de opacidad
    }, 3000);
}


/**
 * Actualiza la cantidad de un item en el carrito.
 * @param {string} variantId - El ID de la variante a actualizar.
 * @param {number} change - El cambio en la cantidad (+1 o -1).
 */
function updateCartQuantity(variantId, change) {
    let cart = getCart();
    const itemIndex = cart.findIndex(item => item.variantId === variantId);

    if (itemIndex > -1) {
        cart[itemIndex].quantity += change;
        if (cart[itemIndex].quantity <= 0) {
            // Si la cantidad llega a 0 o menos, eliminar el item
            cart.splice(itemIndex, 1);
        }
        saveCart(cart);
        displayCart(); // Volver a renderizar el carrito
    }
}

/**
 * Elimina un item del carrito.
 * @param {string} variantId - El ID de la variante a eliminar.
 */
function removeFromCart(variantId) {
    let cart = getCart();
    const updatedCart = cart.filter(item => item.variantId !== variantId);
    saveCart(updatedCart);
    displayCart(); // Volver a renderizar el carrito
}

/**
 * Renderiza el contenido del carrito en la página.
 * Busca los elementos HTML con IDs específicos para mostrar los datos.
 */
function displayCart() {
    const cart = getCart();
    const cartItemsContainer = document.getElementById('cart-items-container'); // Contenedor para las tarjetas de items
    const cartTotalElement = document.getElementById('cart-total'); // span o div para el total
    const emptyCartMessage = document.getElementById('empty-cart-message'); // div para mensaje de carrito vacío
    const cartContainer = document.getElementById('cart-container'); // Contenedor principal del carrito (items + resumen)
    const checkoutButton = document.getElementById('whatsapp-checkout-button'); // Botón de pedir por WhatsApp

    if (!cartItemsContainer || !cartTotalElement || !emptyCartMessage || !cartContainer || !checkoutButton) {
        // No estamos en la página del carrito, o faltan elementos
        return;
    }

    // Limpiar contenido anterior
    cartItemsContainer.innerHTML = '';

    if (cart.length === 0) {
        // Mostrar mensaje de carrito vacío y ocultar contenedor principal
        emptyCartMessage.classList.remove('hidden');
        cartContainer.classList.add('hidden');
        cartTotalElement.textContent = '0.00';
    } else {
        // Ocultar mensaje de carrito vacío y mostrar contenedor principal
        emptyCartMessage.classList.add('hidden');
        cartContainer.classList.remove('hidden');

        let totalGeneral = 0;

        cart.forEach(item => {
            const subtotal = item.price * item.quantity;
            totalGeneral += subtotal;

            // Crear atributos legibles
            const attributesString = Object.entries(item.variantAttributes)
                .map(([key, value]) => `${key.charAt(0).toUpperCase() + key.slice(1)}: ${value}`)
                .join(', ');

            // Crear la tarjeta del item
            const itemCard = document.createElement('div');
            itemCard.className = 'bg-white rounded-lg shadow-sm p-4 flex flex-col sm:flex-row gap-4 border border-gray-100'; // Estilos para la tarjeta
            itemCard.innerHTML = `
                <div class="flex-shrink-0 w-24 h-24 sm:w-28 sm:h-28 self-center sm:self-start">
                    <img src="${item.imageUrl}" alt="Imagen de ${item.productName}" class="w-full h-full object-cover rounded-md" onerror="this.src='https://placehold.co/112x112/e0e0e0/333?text=Img'; this.alt='Error Imagen'">
                </div>

                <div class="flex-grow flex flex-col sm:flex-row justify-between gap-4">

                    <div class="flex flex-col justify-between">
                        <div>
                            <p class="font-semibold text-gray-800 text-base sm:text-lg leading-tight">${item.productName}</p>
                            ${attributesString ? `<p class="text-sm text-gray-500 mb-2">${attributesString}</p>` : ''}
                            <button class="remove-item text-red-500 hover:text-red-700 text-sm font-medium" data-variant-id="${item.variantId}">
                                Eliminar
                            </button>
                        </div>

                        <div class="flex items-center space-x-2 mt-2 sm:mt-0">
                            <button class="quantity-change text-orange-600 hover:text-orange-800 p-1 border rounded-md disabled:opacity-50 disabled:cursor-not-allowed" data-variant-id="${item.variantId}" data-change="-1" ${item.quantity <= 1 ? 'disabled' : ''}>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" /></svg>
                            </button>
                            <span class="font-medium text-sm w-8 text-center">${item.quantity} u.</span>
                            <button class="quantity-change text-orange-600 hover:text-orange-800 p-1 border rounded-md" data-variant-id="${item.variantId}" data-change="1">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="text-left sm:text-right flex-shrink-0 pt-2 sm:pt-0">
                        <p class="font-semibold text-lg text-gray-800">$${subtotal.toFixed(2)}</p>
                        ${item.quantity > 1 ? `<p class="text-sm text-red-500 mt-1">($${item.price.toFixed(2)} c/u)</p>` : ''}
                    </div>
                </div>
            `;
            cartItemsContainer.appendChild(itemCard);
        });

        // Actualizar total general
        cartTotalElement.textContent = totalGeneral.toFixed(2);

        // --- Re-asignar event listeners (IMPORTANTE) ---
        // Es necesario volver a asignar listeners después de regenerar el HTML

        // Listeners para botones +/-
        cartItemsContainer.querySelectorAll('.quantity-change').forEach(button => {
            // Remover listener antiguo si existe (opcional, pero buena práctica)
            // button.removeEventListener('click', handleQuantityChange); // Necesitarías una función nombrada
            button.addEventListener('click', handleQuantityChange);
        });

        // Listeners para botón Eliminar
        cartItemsContainer.querySelectorAll('.remove-item').forEach(button => {
            // button.removeEventListener('click', handleRemoveItem);
            button.addEventListener('click', handleRemoveItem);
        });
    }
    updateCartCounter(); // Asegurar que el contador del header esté sincronizado
}

// --- Funciones Handler para listeners (para evitar duplicación y facilitar removerlos si fuera necesario) ---

function handleQuantityChange(event) {
    const targetButton = event.currentTarget;
    const variantId = targetButton.dataset.variantId;
    const change = parseInt(targetButton.dataset.change);
    updateCartQuantity(variantId, change);
}

function handleRemoveItem(event) {
    const targetButton = event.currentTarget;
    const variantId = targetButton.dataset.variantId;
    // Usar un modal más elegante sería ideal, pero confirm es funcional
    if (confirm('¿Seguro que quieres eliminar este producto del carrito?')) {
        removeFromCart(variantId);
    }
}

/**
 * Actualiza el contador de items en el header.
 */
function updateCartCounter() {
    const cartCounterElement = document.getElementById('cart-counter'); // El span en tu header
    if (cartCounterElement) {
        const count = getCartItemCount();
        cartCounterElement.textContent = count;
        // Opcional: Ocultar el contador si es 0
        cartCounterElement.classList.toggle('hidden', count === 0);
    }
}

// --- Código existente para el menú móvil ---
document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuButton && mobileMenu) {
        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // --- Inicialización del Carrito ---
    // Llama a displayCart SI estamos en la página del carrito
    if (document.getElementById('cart-items-container')) {
        displayCart();
    }

    // Actualiza el contador del header al cargar cualquier página
    updateCartCounter();

    // Escucha por actualizaciones del carrito desde otras partes (opcional pero bueno)
    window.addEventListener('cart-updated', (event) => {
        // console.log('Evento cart-updated recibido:', event.detail);
        updateCartCounter();
        // Si estamos en la página del carrito, también la refrescamos
        if (document.getElementById('cart-items-container')) {
            displayCart();
        }
    });

    // --- Lógica del Botón WhatsApp (Asegúrate que el botón tenga el ID 'whatsapp-checkout-button') ---
    const checkoutButton = document.getElementById('whatsapp-checkout-button');
    if (checkoutButton) {
        checkoutButton.addEventListener('click', () => {
            const cart = getCart();
            if (cart.length === 0) {
                alert("Tu carrito está vacío.");
                return;
            }

            const VENDEDOR_WHATSAPP = '5215638193041'; // <-- ¡¡¡REEMPLAZA CON TU NÚMERO!!! (Formato internacional sin +, ej. 521 para México celular)

            // Mensaje inicial con un toque deportivo
            let message = " *¡Hola, equipo de Angel Viajero!* \n\n";
            message += "Estoy listo para encestar mi pedido. Aquí te dejo mis selecciones:\n\n";
            let totalPedido = 0;

            cart.forEach(item => {
                const attributesString = Object.entries(item.variantAttributes)
                    .map(([key, value]) => `${key.charAt(0).toUpperCase() + key.slice(1)}: ${value}`)
                    .join(', ');
                const subtotal = item.price * item.quantity;
                message += `• *${item.quantity}x ${item.productName}* (${attributesString})\n`;
                message += `   ▹ Precio Unitario: $${item.price.toFixed(2)}\n\n`;
                totalPedido += subtotal;
            });

            message += `*Total del Pedido: $${totalPedido.toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}*\n\n`;
            message += "¡Espero tu confirmación para coordinar el pago y la entrega! \n";
            message += "¡Vamos a encestar este pedido y seguir brillando en la cancha!";
            
            const whatsappUrl = `https://wa.me/${VENDEDOR_WHATSAPP}?text=${encodeURIComponent(message)}`;

            // Abrir en una nueva pestaña
            window.open(whatsappUrl, '_blank');
        });
    }

}); // Fin DOMContentLoaded
