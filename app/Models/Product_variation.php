<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'price',
        'stock_quantity',
        'is_active',
    ];

    // Relacionamento com o produto principal
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
