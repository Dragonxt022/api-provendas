<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpresaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cnpj' => $this->cnpj,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'website' => $this->website,
            'social_media' => json_decode($this->social_media),  // Se for JSON, converta para array
            'logo' => $this->logo,
            'fiscal_status' => $this->fiscal_status,
            'company_type' => $this->company_type,
            'operating_since' => $this->operating_since,
            'status' => $this->status,
            'owner_id' => $this->owner_id,
            'created_at_date' => Carbon::parse($this->created_at)->toDateString(), // Apenas a data
            'created_at_time' => Carbon::parse($this->created_at)->toTimeString(), // Apenas a hora
            'updated_at_date' => Carbon::parse($this->updated_at)->toDateString(),
            'updated_at_time' => Carbon::parse($this->updated_at)->toTimeString(),
        ];
    }
}
