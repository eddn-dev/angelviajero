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
    // Aquí podrían ir otros métodos como create, store, edit, update, destroy si manejaras productos desde un admin

    private function obtenerProductos()
    {
        $jsonPath = database_path('data/products.json');
        if (!File::exists($jsonPath)) {
            // Manejar el caso donde el archivo no existe
            return collect([]); // Devuelve una colección vacía
        }
        // Decodifica el JSON y lo convierte en una Colección de Laravel
        return collect(json_decode(File::get($jsonPath), true));
    }

    /**
     * Muestra la página de detalle de un producto.
     * (Tu método existente)
     * @param string $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $productos = $this->obtenerProductos();
        // Busca el producto por su 'id' (asegúrate que el ID en la URL coincida con el 'id' en el JSON)
        $producto = $productos->firstWhere('id', $id);

        if (!$producto) {
            // Si no se encuentra el producto, redirigir o mostrar error 404
            abort(404, 'Producto no encontrado');
        }

        // Pasar el producto encontrado a la vista
        return view('productos.show', compact('producto'));
    }

    /**
     * Muestra la página principal de la tienda con productos agrupados por categoría.
     *
     * @return \Illuminate\View\View
     */
    public function tiendaIndex()
    {
        $productos = $this->obtenerProductos();

        // Agrupar los productos por el campo 'categoria'
        $productosPorCategoria = $productos->groupBy('categoria')
                                           ->sortKeys(); // Opcional: ordenar categorías alfabéticamente

        // Pasar los productos agrupados a la vista
        return view('tienda.index', compact('productosPorCategoria'));
    }

    /**
     * (Opcional) Muestra productos filtrados por categoría.
     *
     * @param string $categoriaSlug El nombre de la categoría (podría necesitarse un slug si hay espacios/acentos)
     * @return \Illuminate\View\View
     */
    // public function tiendaPorCategoria($categoriaSlug)
    // {
    //     $productos = $this->obtenerProductos();

    //     // Aquí necesitarías una lógica para mapear el $categoriaSlug a la categoría real si difieren
    //     $categoriaReal = ucwords(str_replace('-', ' ', $categoriaSlug)); // Ejemplo simple de conversión

    //     $productosFiltrados = $productos->where('categoria', $categoriaReal);

    //     if ($productosFiltrados->isEmpty()) {
    //          abort(404, 'Categoría no encontrada o sin productos');
    //     }

    //     // Podrías reutilizar la vista tienda.index o crear una específica
    //     return view('tienda.categoria', [
    //         'productos' => $productosFiltrados,
    //         'categoriaNombre' => $categoriaReal
    //     ]);
    // }
}
