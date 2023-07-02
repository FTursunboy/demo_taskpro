<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'fio' => $this->fio,
            'phone' => $this->phone,
            'email' => $this->email,
            'position' => $this->position,
            'address' => $this->address,
            'is_client' => $this->is_client,
            'company' => $this->company,
            'lead_id' => $this->lead_id,
        ];
    }
}
