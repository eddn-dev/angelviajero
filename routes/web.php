<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File; // Para leer archivos locales

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $jsonPath = database_path('data/products.json'); 
    $todosLosProductos = collect(); // Iniciar como colección vacía
    $novedades = collect();
    $ofertas = collect();
    $categoriasInfo = collect();

    if (File::exists($jsonPath)) {
        $jsonContent = File::get($jsonPath);
        // Usamos collect para facilitar la manipulación
        $todosLosProductos = collect(json_decode($jsonContent, true)); 

        // Seleccionar los primeros 4 productos para "Novedades"
        $novedades = $todosLosProductos->slice(0, 4); 

        // Filtrar productos en oferta (tomar hasta 4 como ejemplo)
        $ofertas = $todosLosProductos->where('en_oferta', true)->take(4);

        // Obtener categorías únicas para la sección visual (simplificado)
        $categoriasInfo = $todosLosProductos->pluck('categoria') // Extrae solo la columna 'categoria'
                                     ->filter()         // Elimina valores nulos o vacíos
                                     ->unique()         // Obtiene solo valores únicos
                                     ->map(function ($catNombre) { // Mapea para crear una estructura útil
                                         return [
                                             'nombre' => $catNombre,
                                             // TODO: Asignar imagen y URL real para cada categoría
                                             'imagen' => 'placeholder_cat.jpg', 
                                             'url' => '#' 
                                         ];
                                     })->values(); // Reindexa el array resultante
                                     
    } else {
        // Log::error("El archivo products.json no se encontró en: " . $jsonPath);
    }
    
    // Pasar todas las colecciones necesarias a la vista
    return view('welcome', [
        'novedades' => $novedades,
        'ofertas' => $ofertas,
        'categoriasInfo' => $categoriasInfo 
    ]); 
})->name('home'); 

Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');
Route::get('/carrito', [CartController::class, 'index'])->name('carrito.index');
Route::get('/tienda', [ProductoController::class, 'tiendaIndex'])->name('tienda.index');
Route::get('/contacto', [HomeController::class, 'contactoIndex'])->name('contacto.index');
Route::get('/promociones', [HomeController::class, 'promocionesIndex'])->name('promociones.index');
