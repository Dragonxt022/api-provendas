<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    // Define quais campos podem ser preenchidos em massa
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
        'owner_id',
        'company_type',
        'operating_since',
        'status'
    ];

    // Relacionamento com o modelo User (dono da empresa)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Opcional: Se você quiser acessar os dados de redes sociais como array, pode usar a mutator para decodificar o JSON
    public function getSocialMediaAttribute($value)
    {
        return json_decode($value, true);
    }

    // Opcional: Se você quiser salvar os dados de redes sociais como JSON automaticamente
    public function setSocialMediaAttribute($value)
    {
        $this->attributes['social_media'] = json_encode($value);
    }
}
