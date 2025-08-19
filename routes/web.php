<?php

use App\Http\Controllers\WhatsAppRouterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/whatsapp', [WhatsAppRouterController::class, 'redirect'])->name('whatsapp.redirect');
