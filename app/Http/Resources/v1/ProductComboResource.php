<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProductComboResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'component_id' => $this->component_id,
            'quantity' => $this->quantity,
            'combo_price' => number_format($this->combo_price, 2, ',', '.'), // Formatar preço do combo
            'is_active' => $this->is_active,
            'expiration_date' => $this->expiration_date ? Carbon::parse($this->expiration_date)->format('d/m/Y') : null, // Formatar data de expiração
            'created_at_date' => Carbon::parse($this->created_at)->toDateString(), // Apenas a data
            'created_at_time' => Carbon::parse($this->created_at)->toTimeString(), // Apenas a hora
            'updated_at_date' => Carbon::parse($this->updated_at)->toDateString(),
            'updated_at_time' => Carbon::parse($this->updated_at)->toTimeString(),
        ];
    }
}
