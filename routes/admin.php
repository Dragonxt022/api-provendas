<?php

use App\Http\Controllers\api\v1\Auth\AuthController;
use App\Http\Controllers\api\v1\Empresa\EmpresaController;
use App\Http\Controllers\api\v1\Fornecedores\SupplierController;
use App\Http\Controllers\api\v1\Produtos\ProductController;
use App\Http\Controllers\api\v1\Usuarios\UserController;
use Illuminate\Support\Facades\Route;


// Rotas administrativas ##
// Rotas para autenticação e usuários
Route::prefix('v1')->group(function () {
    // Autenticação
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'perfil']);

    // Usuários
    Route::get('/users', [UserController::class, 'index']);
});

// Rotas para empresas
Route::prefix('v1/empresas')->group(function () {
    Route::get('/', [EmpresaController::class, 'index']); // Listar todas as empresas
    Route::post('/', [EmpresaController::class, 'store']); // Criar uma nova empresa
    Route::put('/{id}', [EmpresaController::class, 'update']); // Atualizar uma empresa
    Route::delete('/{id}', [EmpresaController::class, 'destroy']); // Excluir uma empresa
});

// Rotas para produtos
Route::prefix('v1/products')->group(function () {
    Route::get('/', [ProductController::class, 'index']); // Listar todos os produtos
    Route::get('/{id}', [ProductController::class, 'show']); // Exibir detalhes de um produto
    Route::post('/', [ProductController::class, 'store']); // Criar um produto
    Route::put('/{id}', [ProductController::class, 'update']); // Atualizar um produto
    Route::delete('/{id}', [ProductController::class, 'destroy']); // Excluir um produto

    // Rotas específicas relacionadas a produtos
    Route::get('/{product}/promotions', [ProductController::class, 'promotions']); // Obter promoções de um produto
    Route::get('/{product}/variations', [ProductController::class, 'variations']); // Obter variações de um produto
    Route::get('/{product}/combos', [ProductController::class, 'combos']); // Obter combos de um produto
});


// Rotas para produtos
Route::prefix('v1/suppliers')->group(function () {
    Route::get('/', [SupplierController::class, 'index']);
    Route::get('/{id}', [SupplierController::class, 'show']);
    Route::post('/', [SupplierController::class, 'store']);
    Route::put('/{id}', [SupplierController::class, 'update']);
    Route::delete('/{id}', [SupplierController::class, 'destroy']);
});
