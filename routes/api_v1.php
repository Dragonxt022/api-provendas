<?php

use App\Http\Controllers\api\v1\Auth\AuthController;
use App\Http\Controllers\api\v1\Empresa\EmpresaController;
use App\Http\Controllers\api\v1\Produtos\ProductController;
use App\Http\Controllers\api\v1\Usuarios\UserController;
use Illuminate\Support\Facades\Route;

// Grupo de Rotas da api v1
Route::prefix('v1')->group(function () {

    // Sistema de Autentificação
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::post('/register', [AuthController::class, 'register']);

    // Requer autenticação
    Route::middleware('auth:sanctum')->group(function () {
        // Rota para logout (POST)
        Route::post('/logout', [AuthController::class, 'logout']);

        // Rota para acessar o perfil do usuário (GET)
        Route::get('/profile', [AuthController::class, 'perfil']);

        // Outras rotas que exigem autenticação
        Route::get('/users', [UserController::class, 'index']);
    });


    // API

    // Usuarios
    Route::get('/users', [UserController::class, 'index']);

    // Empresa
    Route::get('/empresas', [EmpresaController::class, 'index']);

    // Produtos
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);

    Route::post('/cadastrar-produto', [ProductController::class, 'store']);
    Route::put('/update-produto/{id}', [ProductController::class, 'update']);
    Route::delete('/delete-produto/{id}', [ProductController::class, 'destroy']);


    // Buscas
    Route::get('products/{product}/promotions', [ProductController::class, 'promotions']);
    Route::get('products/{product}/variations', [ProductController::class, 'variations']);
    Route::get('products/{product}/combos', [ProductController::class, 'combos']);


});

