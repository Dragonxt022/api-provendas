<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), // Nome do produto
            'sku' => $this->faker->unique()->bothify('SKU-####'), // SKU único
            'barcode' => $this->faker->ean13(), // Código de barras
            'description' => $this->faker->sentence(), // Descrição
            'category_id' => Categorie::factory(), // Relacionamento com categoria
            'price' => $this->faker->randomFloat(2, 10, 100), // Preço entre 10 e 100
            'cost_price' => $this->faker->randomFloat(2, 5, 50), // Preço de custo entre 5 e 50
            'stock_quantity' => $this->faker->numberBetween(0, 100), // Estoque aleatório
            'min_stock' => $this->faker->numberBetween(1, 10), // Estoque mínimo
            'is_active' => $this->faker->boolean(90), // 90% de chance de estar ativo
            'is_managed' => $this->faker->boolean(50), // 50% de chance de ser gerenciado
            'image_path' => $this->faker->imageUrl(640, 480, 'products', true), // Imagem do produto
            'ncm_code' => $this->faker->randomNumber(8, true), // Código NCM
            'icms' => $this->faker->optional()->randomFloat(2, 0, 25), // ICMS (opcional, até 25%)
            'supplier_id' => Supplier::factory(), // Relacionamento com fornecedor
            'expiration_date' => $this->faker->optional()->dateTimeBetween('+1 week', '+1 year'), // Data de validade (opcional)
        ];
    }
}
