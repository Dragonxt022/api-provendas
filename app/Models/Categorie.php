<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'empresa_id',
        'is_active',
    ];

    /**
     * Relacionamento: Categoria pertence a uma empresa
     */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
