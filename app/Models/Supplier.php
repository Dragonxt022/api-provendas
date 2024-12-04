<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
        'cpf',
        'contact_name',
        'phone',
        'email',
        'address',
        'image_path',
        'empresa_id',
        'is_active',
    ];


    // Relacionamento com produtos
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
