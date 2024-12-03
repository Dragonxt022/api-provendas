<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Categorie::class;

    public function definition(): array
    {
        // Defina um conjunto fixo de categorias
        $categories = [
            'Bebidas',
            'Refrigerantes',
            'Lanches',
            'Comidas',
            'Salgadinhos',
            'Doces',
            'Alimentos Naturais',
            'Frutas',
            'Vegetais',
            'Produtos Orgânicos'
        ];

        return [
            'name' => $this->faker->randomElement($categories), // Escolhe aleatoriamente uma categoria da lista
            'description' => $this->faker->sentence(),
            'image_path' => $this->faker->imageUrl(640, 480, 'categories'),
            'is_active' => $this->faker->boolean(100),
        ];
    }
}
