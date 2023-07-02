<?php

namespace App\Http\Resources\API\V1;

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
            'name' => $this->contact,
            'author' => $this->author,
            'status' => new LeadStatusResource($this->status),
            'state' => new LeadStateResource($this->state),
            'source' => new LeadSourceResource($this->leadSource),
        ];
    }
}
