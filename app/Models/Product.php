<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'barcode',
        'description',
        'category_id',
        'price',
        'cost_price',
        'stock_quantity',
        'min_stock',
        'empresa_id',
        'is_active',
        'is_managed',
        'image_path',
        'ncm_code',
        'icms',
        'supplier_id',
        'expiration_date',
    ];

    // Método booted() para aplicar o escopo global


    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    // Relacionamento com a categoria
    public function categories()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Relacionamento com o fornecedor
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relacionamento com variações
    public function variations()
    {
        return $this->hasMany(Product_variation::class);
    }

    // Relacionamento com combos
    public function combos()
    {
        return $this->hasMany(Product_combo::class);
    }

    // Relacionamento com promoções
    public function promotions()
    {
        return $this->hasMany(Product_promotion::class);
    }
}
