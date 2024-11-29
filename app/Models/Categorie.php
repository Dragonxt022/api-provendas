<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriesFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'is_active',
    ];

    // Relacionamento com produtos
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
