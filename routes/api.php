<?php

use App\Http\Controllers\api\v1\EmpresaController;
use App\Http\Controllers\api\v1\ProductController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Sistema de login



// Route::post('/register', [AuthController::class, 'register']);

// Route::middleware(['auth:sanctum'])->post('/logout', [AuthController::class, 'logout']);

// Grupo de Rotas da api v1
Route::prefix('v1')->group(function () {

    // Sistema de Autentificação
    Route::post('/login', [AuthController::class, 'login']);

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

