<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\VendedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('vendas')->group(function () {
        Route::get('/', [VendaController::class, 'index']);
        Route::post('/', [VendaController::class, 'store']);
    });

    Route::prefix('vendedores')->group(function () {
        Route::get('/', [VendedorController::class, 'index']);
        Route::post('/', [VendedorController::class, 'store']);
        Route::get('/{id}', [VendaController::class, 'porVendedor']);
        Route::post('/{id}/reenviar-email', [VendaController::class, 'reenviarEmailComissao']);
    });

    Route::post('/logout', function (Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(['mensagem' => 'Logout realizado com sucesso.']);
    });
});
