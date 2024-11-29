<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_combo extends Model
{
    /** @use HasFactory<\Database\Factories\ProductComboFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'component_id',
        'quantity',
        'combo_price', // Preço do combo
        'is_active', // Indica se o combo está ativo
        'expiration_date', // Data de expiração do combo (se aplicável)
    ];

    // Produto principal (combo)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Produto que faz parte do combo
    public function component()
    {
        return $this->belongsTo(Product::class, 'component_id');
    }

    /**
     * Verifica se o combo está ativo
     */
    public function isActive()
    {
        return $this->is_active;
    }

    /**
     * Verifica se o combo está expirado
     */
    public function isExpired()
    {
        return $this->expiration_date && now()->greaterThan($this->expiration_date);
    }
}
