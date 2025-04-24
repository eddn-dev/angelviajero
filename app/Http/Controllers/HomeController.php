<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Necesario si lees JSON aquí, pero no para contacto

class HomeController extends Controller
{
    /**
     * Muestra la página principal (Landing Page).
     * (Asegúrate que esta lógica coincida con tu implementación actual)
     */
    public function index()
    {
        // Lógica actual para obtener novedades, ofertas, etc. del JSON
        $jsonPath = database_path('data/products.json');
        $productos = collect(json_decode(File::get($jsonPath), true));

        $novedades = $productos->sortByDesc('id')->take(4); // Ejemplo, ajusta según tu lógica
        $ofertas = $productos->where('en_oferta', true)->take(4); // Ejemplo
        $categoriasInfo = $productos->pluck('categoria')->unique()->map(function ($categoria) {
             // Lógica para obtener imagen/url de categoría si la tienes
             return ['nombre' => $categoria, 'imagen' => strtolower(str_replace(' ', '-', $categoria)) . '.jpg', 'url' => '#']; // Placeholder
        });


        return view('welcome', compact('novedades', 'ofertas', 'categoriasInfo'));
    }

    /**
     * Muestra la página de Contacto.
     *
     * @return \Illuminate\View\View
     */
    public function contactoIndex()
    {
        // No se necesitan datos especiales para esta vista, solo devolverla.
        return view('contacto.index');
    }

    public function promocionesIndex()
    {
        $jsonPath = database_path('data/promociones.json');
        $promociones = collect([]); // Valor por defecto

        if (File::exists($jsonPath)) {
            $promociones = collect(json_decode(File::get($jsonPath), true));
        } else {
            // Opcional: Loggear un error si el archivo no existe
            // Log::warning('Archivo promociones.json no encontrado.');
        }

        // Pasar las promociones a la vista
        return view('promociones.index', compact('promociones'));
    }
}
