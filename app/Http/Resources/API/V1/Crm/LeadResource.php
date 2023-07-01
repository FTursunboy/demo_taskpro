<?php

namespace App\Http\Resources\Api\V1\Crm;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
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
            'contact' => $this->contact,
            'lead_status' => $this->leadStatus->name,
            'lead_source' => $this->leadSource->name,
            'lead_state' => $this->leadState->name,
            'author' => $this->author,
        ];
    }
}
