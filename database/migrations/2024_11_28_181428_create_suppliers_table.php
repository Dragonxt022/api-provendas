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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id(); // Identificador único do fornecedor
            $table->string('name', 255); // Nome do fornecedor
            $table->string('cnpj', 18)->unique()->nullable(); // CNPJ do fornecedor (opcional)
            $table->string('cpf', 14)->unique()->nullable(); // CPF do fornecedor (opcional)
            $table->string('contact_name', 255)->nullable(); // Nome do responsável pelo contato (opcional)
            $table->string('phone', 20)->nullable(); // Telefone do fornecedor (opcional)
            $table->string('email', 150)->nullable(); // E-mail do fornecedor (opcional)
            $table->text('address')->nullable(); // Endereço completo do fornecedor (opcional)

            $table->foreignId('empresa_id')->constrained('empresas');

            $table->string('image_path')->nullable(); // Caminho para a imagem ou logo do fornecedor (opcional)
            $table->boolean('is_active')->default(true); // Indica se o fornecedor está ativo
            $table->timestamps(); // Data de criação e atualização
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
