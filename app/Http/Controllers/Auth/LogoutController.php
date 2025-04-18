<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Cierra la sesión del usuario y lo redirige al home.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        // Invalida sesión y token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Borra también la cookie de "remember me"
        Cookie::queue(Cookie::forget(Auth::getRecallerName()));

        return redirect()->route('home');
    }

}
