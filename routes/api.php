<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\EmailVerified;

Route::prefix('v1')->group(function() {
    Route::get('/email/verify/{id}/{hash}', [UserController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);

    Route::middleware(['auth:sanctum', EmailVerified::class])->group(function() {
        Route::get('/test', function() {
            return response()->json("All is working fine!");
        });

        // Clientes
        Route::apiResource('clientes', ClienteController::class);
        
        // Vendas
        Route::apiResource('vendas', VendaController::class);
    });
});
