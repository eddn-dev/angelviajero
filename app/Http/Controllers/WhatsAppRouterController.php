<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Opcional: para tracking

class WhatsAppRouterController extends Controller
{
    /**
     * Selecciona un número de WhatsApp basado en una lógica de distribución
     * y redirige al usuario.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        // Obtenemos los números y pesos desde nuestro archivo de configuración
        $destinos = config('services.whatsapp_router.numbers');

        if (empty($destinos)) {
            // Si no hay números configurados, redirige a un número de fallback o muestra un error.
            Log::error('No se han configurado números para el WhatsApp Router.');
            // Puedes redirigir a una página de error o un número por defecto.
            return redirect()->away('https://wa.me/5651899438');
        }

        // --- LÓGICA DE SELECCIÓN PONDERADA ---
        $pesoTotal = array_sum(array_column($destinos, 'weight'));
        $numeroAleatorio = mt_rand(1, $pesoTotal);
        $numeroSeleccionado = $destinos[0]['number']; // Fallback

        foreach ($destinos as $destino) {
            if ($numeroAleatorio <= $destino['weight']) {
                $numeroSeleccionado = $destino['number'];
                break;
            }
            $numeroAleatorio -= $destino['weight'];
        }

        // Construimos la URL final
        $urlWhatsApp = "https://wa.me/{$numeroSeleccionado}";

        // (Opcional) Registramos el evento para tracking interno
        Log::info("Redirigiendo lead a WhatsApp: {$numeroSeleccionado}");

        // Realizamos la redirección. Usamos redirect()->away() para URLs externas.
        return redirect()->away($urlWhatsApp);
    }
}