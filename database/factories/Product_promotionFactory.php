<?php

namespace Database\Factories;

use App\Models\Product_promotion;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class Product_promotionFactory extends Factory
{
    protected $model = Product_promotion::class;

    public function definition()
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id, // Seleciona um produto aleatório
            'promotional_price' => $this->faker->randomFloat(2, 1, 100), // Preço promocional entre 1 e 100 reais
            'start_date' => $this->faker->dateTimeThisYear(), // Data de início da promoção (ano atual)
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month'), // Data de término da promoção (máximo de 1 mês)
            'is_active' => $this->faker->boolean(80), // 80% de chance de a promoção estar ativa
        ];
    }
}
