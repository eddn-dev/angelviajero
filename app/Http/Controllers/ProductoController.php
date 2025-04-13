<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Para leer archivos
use Illuminate\Support\Collection; // Para usar colecciones de Laravel

class ProductoController extends Controller
{
    /**
     * Muestra la página de inicio (si decides mover la lógica de la ruta aquí).
     * Este método es opcional aquí, podrías dejar la lógica en routes/web.php.
     */
    // public function index() { ... }

    /**
     * Muestra la página de detalle para un producto específico.
     *
     * @param  string  $id El ID del producto recibido desde la URL.
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $jsonPath = database_path('data/products.json'); // Ruta al JSON
        $productoEncontrado = null;

        if (File::exists($jsonPath)) {
            $jsonContent = File::get($jsonPath);
            // Decodifica y convierte a una Colección de Laravel para búsqueda fácil
            $todosLosProductos = collect(json_decode($jsonContent, true)); 

            // Busca el producto cuyo 'id' coincida con el $id recibido
            // firstWhere es un método útil de las colecciones
            $productoEncontrado = $todosLosProductos->firstWhere('id', $id);

        } else {
             // Si el JSON no existe, no podemos encontrar el producto
             abort(500, 'Archivo de productos no encontrado.'); // O un error diferente
        }

        // Si después de buscar, no encontramos un producto con ese ID, muestra error 404
        if (!$productoEncontrado) {
            abort(404, 'Producto no encontrado.');
        }

        // Si encontramos el producto, pasamos sus datos a la vista 'productos.show'
        // Asegúrate de crear esta vista en: resources/views/productos/show.blade.php
        return view('productos.show', ['producto' => $productoEncontrado]);
    }

    // Aquí podrían ir otros métodos como create, store, edit, update, destroy si manejaras productos desde un admin
}
