<?php

use App\Http\Controllers\api\v1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// Grupo de Rotas da api v1
Route::prefix('v1')->group(function () {

    // Sistema de Autentificação
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);


});

// Requer autenticação
Route::middleware('auth:sanctum')->group(function () {
// rots administrativas
    require __DIR__.'/admin.php';

});
