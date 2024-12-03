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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Identificador único do produto
            $table->string('name', 255); // Nome do produto
            $table->string('sku', 50)->nullable()->unique(); // SKU (código único do produto)
            $table->string('barcode', 50)->nullable(); // Código de barras (opcional)
            $table->text('description')->nullable(); // Descrição detalhada (opcional)
            $table->foreignId('category_id', 50)->nullable()->constrained();
            $table->decimal('price', 10, 2); // Preço de venda do produto
            $table->decimal('cost_price', 10, 2)->nullable(); // Preço de custo do produto (opcional)
            $table->integer('stock_quantity')->default(0); // Quantidade de estoque atual
            $table->integer('min_stock')->default(5); // Quantidade mínima em estoque

            $table->foreignId('empresa_id')->constrained('empresas');

            $table->boolean('is_active')->default(true); // Indica se o produto está ativo
            $table->boolean('is_managed')->default(false); // Indica se o produto será gerenciado
            $table->string('image_path')->nullable(); // Caminho para a imagem (opcional)
            $table->string('ncm_code', 10)->nullable(); // Código NCM (opcional)
            $table->decimal('icms', 5, 2)->nullable(); // Alíquota de ICMS (opcional)
            $table->foreignId('supplier_id')->nullable()->constrained(); // Relacionamento com fornecedor (opcional)
            $table->date('expiration_date')->nullable(); // Data de validade do produto
            $table->timestamps(); // Data de criação e atualização
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
