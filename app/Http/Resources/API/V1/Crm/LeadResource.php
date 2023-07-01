<?php

namespace App\Http\Resources\Api\V1\CRM;

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
            'author' => $this->author,
            'status' => new LeadResource($this->status),
            'state' => new LeadResource($this->state),
            'source' => new LeadResource($this->leadSource),

        ];
    }
}
