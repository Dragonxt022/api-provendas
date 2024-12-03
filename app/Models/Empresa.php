<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'website',
        'social_media',
        'logo',
        'fiscal_status',
        'company_type',
        'operating_since',
        'status',
    ];

    /**
     * Relacionamento: Empresa pode ter muitos usuários
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relacionamento: Empresa pode ter muitas categorias
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Relacionamento: Empresa pode ter muitos fornecedores
     */
    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    /**
     * Relacionamento: Empresa pode ter muitos produtos
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
