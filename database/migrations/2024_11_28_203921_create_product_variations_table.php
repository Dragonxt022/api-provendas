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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id(); // ID único da variação
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Produto principal
            $table->string('name', 255); // Nome da variação (ex.: "Tamanho: M, Cor: Azul")
            $table->string('sku', 50)->unique()->nullable(); // SKU da variação
            $table->decimal('price', 10, 2); // Preço da variação
            $table->integer('stock_quantity')->default(0); // Estoque da variação
            $table->boolean('is_active')->default(true); // Indica se a variação está ativa
            $table->timestamps(); // Datas de criação e atualização
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
