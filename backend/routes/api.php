<?php

use App\Http\Controllers\VendaController;
use App\Http\Controllers\VendedorController;
use Illuminate\Support\Facades\Route;

Route::prefix('vendas')->group(function () {
    Route::get('/', [VendaController::class, 'index']);
    Route::post('/', [VendaController::class, 'store']);
    Route::get('/vendedor/{id}', [VendaController::class, 'porVendedor']);
});

Route::prefix('vendedores')->group(function () {
    Route::get('/', [VendedorController::class, 'index']);
    Route::post('/', [VendedorController::class, 'store']);
});
