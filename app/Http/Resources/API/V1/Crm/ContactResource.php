<?php

namespace App\Http\Resources\Api\V1\Crm;

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
            'lead_source' => $this->leadSource->name,
            'lead' => $this->lead->name,
            'company' => $this->company,
        ];
    }
}
