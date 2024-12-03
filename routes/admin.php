<?php

use App\Http\Controllers\api\v1\Auth\AuthController;
use App\Http\Controllers\api\v1\Empresa\EmpresaController;
use App\Http\Controllers\api\v1\Produtos\ProductController;
use App\Http\Controllers\api\v1\Usuarios\UserController;
use Illuminate\Support\Facades\Route;


// Rotas administrativas

// Usuario
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/profile', [AuthController::class, 'perfil']);
Route::get('/users', [UserController::class, 'index']);

// Empresa
Route::get('/empresas', [EmpresaController::class, 'index']);

// Produtos
// Route::apiResource('/products', ProductController::class);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::post('/cadastrar-produto', [ProductController::class, 'store']);
Route::put('/update-produto/{id}', [ProductController::class, 'update']);
Route::delete('/delete-produto/{id}', [ProductController::class, 'destroy']);


// Buscas produtos
Route::get('products/{product}/promotions', [ProductController::class, 'promotions']);
Route::get('products/{product}/variations', [ProductController::class, 'variations']);
Route::get('products/{product}/combos', [ProductController::class, 'combos']);


