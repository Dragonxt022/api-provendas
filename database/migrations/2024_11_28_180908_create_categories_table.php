<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Identificador único da categoria
            $table->string('name', 255); // Nome da categoria
            $table->text('description')->nullable(); // Descrição da categoria (opcional)
            $table->string('image_path')->nullable(); // Caminho para a imagem da categoria (opcional)
            $table->boolean('is_active')->default(true); // Indica se a categoria está ativa
            $table->timestamps(); // Data de criação e atualização
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
