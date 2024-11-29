<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => ($this->first_name ?? '') . ' ' . ($this->last_name ?? ''),
            'phone' => $this->phone,
            'username' => $this->username,
            'email' => $this->email,
            'status' => $this->is_active ? 'Ativo' : 'Inativo',
            'created_at_date' => Carbon::parse($this->created_at)->toDateString(), // Apenas a data
            'created_at_time' => Carbon::parse($this->created_at)->toTimeString(), // Apenas a hora
            'updated_at_date' => Carbon::parse($this->updated_at)->toDateString(),
            'updated_at_time' => Carbon::parse($this->updated_at)->toTimeString(),
        ];
    }
}
