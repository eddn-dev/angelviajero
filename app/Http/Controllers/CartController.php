<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('carrito.index'); // Asegúrate que el nombre de la vista sea correcto
    }
}