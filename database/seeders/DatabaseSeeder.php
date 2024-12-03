<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Empresa;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Product_combo;
use App\Models\Product_promotion;
use App\Models\Product_variation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar usuários fictícios
        // User::factory(1)->create();
        // Empresa::factory()->create();

        // Criar categorias, fornecedores e produtos
        // Categorie::factory(10)->create();
        // Supplier::factory(5)->create();

        // Criar produtos e suas variações
        // Product::factory(10)
        //     ->create()
        //     ->each(function ($product) {
        //         // Criar 3 variações para cada produto
        //         Product_variation::factory(3)->create(['product_id' => $product->id]);
        //     });

        // Gerar combos
        // Product_combo::factory(30)->create();

        // Gerar promoções
        // Product_promotion::factory(30)->create();


    }

}
