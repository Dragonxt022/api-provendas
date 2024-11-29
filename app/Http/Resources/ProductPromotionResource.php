<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProductPromotionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'promotional_price' => number_format($this->promotional_price, 2, ',', '.'), // Formatar preço promocional
            'start_date' => Carbon::parse($this->start_date)->format('d/m/Y'), // Formatar data de início
            'end_date' => Carbon::parse($this->end_date)->format('d/m/Y'), // Formatar data de término
            'is_active' => $this->is_active,
            'created_at_date' => Carbon::parse($this->created_at)->toDateString(), // Apenas a data
            'created_at_time' => Carbon::parse($this->created_at)->toTimeString(), // Apenas a hora
            'updated_at_date' => Carbon::parse($this->updated_at)->toDateString(),
            'updated_at_time' => Carbon::parse($this->updated_at)->toTimeString(),
        ];
    }
}
