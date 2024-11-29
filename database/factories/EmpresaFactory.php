<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('pt_BR');  // Garantir o locale pt_BR para gerar CPF/CNPJ

        return [
            'name' => $faker->company,
            'cnpj' => $faker->unique()->cnpj,  // Gera um CNPJ único
            'email' => $faker->unique()->email,
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip_code' => $faker->postcode,
            'website' => $faker->url,
            'social_media' => json_encode([$faker->url, $faker->url]),
            'logo' => $faker->imageUrl,
            'fiscal_status' => 'Ativa',
            'owner_id' => \App\Models\User::factory(),
            'company_type' => $faker->randomElement(['MEI', 'LTDA', 'EIRELI', 'SA', 'Outros']),
            'operating_since' => $faker->date(),
            'status' => $faker->boolean,
        ];
    }
}
