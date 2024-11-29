<?php

namespace App\Http\Resources;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'name' => $this->name,
            'sku' => $this->sku,
            'price' => number_format($this->price, 2, ',', '.'),
            'stock_quantity' => $this->stock_quantity,
            'is_active' => $this->is_active,
            'created_at_date' => Carbon::parse($this->created_at)->toDateString(), // Apenas a data
            'created_at_time' => Carbon::parse($this->created_at)->toTimeString(), // Apenas a hora
            'updated_at_date' => Carbon::parse($this->updated_at)->toDateString(),
            'updated_at_time' => Carbon::parse($this->updated_at)->toTimeString(),
        ];
    }
}
