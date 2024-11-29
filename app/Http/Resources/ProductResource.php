<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'barcode' => $this->barcode,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price' => number_format($this->price, 2, ',', '.'),
            'cost_price' => number_format($this->cost_price, 2, ',', '.'),
            'stock_quantity' => $this->stock_quantity,
            'min_stock' => $this->min_stock,
            'is_active' => $this->is_active,
            'is_managed' => $this->is_managed,
            'image_path' => $this->image_path,
            'ncm_code' => $this->ncm_code,
            'supplier_id' => $this->supplier_id,
            'expiration_date' => $this->expiration_date ? Carbon::parse($this->expiration_date)->format('d/m/Y') : null, // Formatar data
            'created_at_date' => Carbon::parse($this->created_at)->toDateString(), // Apenas a data
            'created_at_time' => Carbon::parse($this->created_at)->toTimeString(), // Apenas a hora
            'updated_at_date' => Carbon::parse($this->updated_at)->toDateString(),
            'updated_at_time' => Carbon::parse($this->updated_at)->toTimeString(),

            // Agora apenas retornando os IDs dos relacionamentos, sem incluir diretamente no objeto
            'promotion_ids' => $this->promotions->pluck('id'),
            'variation_ids' => $this->variations->pluck('id'),
            'combo_ids' => $this->combos->pluck('id'),
        ];
    }
}
