<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'promotional_price',
        'start_date',
        'end_date',
        'is_active', // Para controlar se a promoção está ativa
    ];

    // Relacionamento com o produto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Verifica se a promoção está ativa
     */
    public function isActive()
    {
        return $this->is_active;
    }

    /**
     * Verifica se a promoção está dentro do período
     */
    public function isWithinPromotionPeriod()
    {
        return now()->between($this->start_date, $this->end_date);
    }
}
