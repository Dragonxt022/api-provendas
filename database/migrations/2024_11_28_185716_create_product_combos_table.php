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
        Schema::create('product_combos', function (Blueprint $table) {
            $table->id(); // ID do combo ou kit
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Produto principal (combo ou kit)
            $table->foreignId('component_id')->constrained('products')->onDelete('cascade'); // Produto que faz parte do combo
            $table->integer('quantity')->default(1); // Quantidade do produto no combo
            $table->decimal('combo_price', 10, 2)->nullable(); // Preço do combo, se necessário
            $table->boolean('is_active')->default(true); // Indica se o combo está ativo
            $table->date('expiration_date')->nullable(); // Data de expiração do combo (se aplicável)
            $table->timestamps(); // Datas de criação e atualização
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_combos');
    }
};
