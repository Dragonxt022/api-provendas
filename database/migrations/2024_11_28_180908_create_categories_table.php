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
            $table->id();
            $table->string('name', 255); // Nome da categoria
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();

            $table->foreignId('empresa_id')->constrained('empresas');

            $table->boolean('is_active')->default(true); // Indica se a categoria está ativa
            $table->timestamps();
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
