<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     */

    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
           'name' => $this->faker->company(),
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'contact_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'address' => $this->faker->address(),
            'image_path' => $this->faker->imageUrl(640, 480, 'suppliers'),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
