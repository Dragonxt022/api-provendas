<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Product_variationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Product_variation::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(), // Relacionamento com produto principal
            'name' => $this->faker->randomElement([
                'Tamanho: P, Cor: Vermelho',
                'Tamanho: M, Cor: Azul',
                'Tamanho: G, Cor: Verde',
                'Tamanho: GG, Cor: Preto'
            ]), // Nome da variação (exemplo)
            'sku' => $this->faker->unique()->bothify('VAR-####'), // SKU único da variação
            'price' => $this->faker->randomFloat(2, 10, 100), // Preço entre 10 e 100
            'stock_quantity' => $this->faker->numberBetween(0, 50), // Estoque entre 0 e 50
            'is_active' => $this->faker->boolean(95), // 90% de chance de estar ativo
        ];
    }
}
