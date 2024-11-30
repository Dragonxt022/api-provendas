<?php

namespace Database\Factories;

use App\Models\Product_combo;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class Product_comboFactory extends Factory
{
    protected $model = Product_combo::class;

    public function definition()
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id, // Seleciona um produto aleatório como o combo principal
            'component_id' => Product::inRandomOrder()->first()->id, // Seleciona um produto aleatório como o componente do combo
            'quantity' => $this->faker->numberBetween(1, 5), // Quantidade aleatória entre 1 e 5
            'combo_price' => $this->faker->randomFloat(2, 10, 100), // Preço aleatório para o combo
            'is_active' => $this->faker->boolean(98), // 80% chance de o combo estar ativo
            'expiration_date' => $this->faker->optional()->dateTimeBetween('now', '+1 year'), // Data de expiração opcional, no futuro
        ];
    }
}
