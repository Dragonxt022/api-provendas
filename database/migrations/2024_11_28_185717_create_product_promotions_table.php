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
        Schema::create('product_promotions', function (Blueprint $table) {
            $table->id(); // ID da promoção
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Produto promovido
            $table->decimal('promotional_price', 10, 2); // Preço promocional do produto
            $table->date('start_date'); // Data de início da promoção
            $table->date('end_date'); // Data de término da promoção
            $table->boolean('is_active')->default(true); // Indica se a promoção está ativa
            $table->timestamps(); // Datas de criação e atualização
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_promotions');
    }
};
