<?php

use App\Http\Controllers\api\v1\ProductController;
use App\Http\Controllers\api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

// Grupo de Rotas da api v1
Route::prefix('v1')->group(function () {

    // Usuarios
    Route::get('/users', [UserController::class, 'index']);

    // Produtos
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/cadastrar-produto', [ProductController::class, 'store']);
    // Buscas
    Route::get('products/{product}/promotions', [ProductController::class, 'promotions']);
    Route::get('products/{product}/variations', [ProductController::class, 'variations']);
    Route::get('products/{product}/combos', [ProductController::class, 'combos']);


});

