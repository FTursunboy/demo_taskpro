<?php

namespace App\Http\Resources\API\V1\Tasks;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class OffersResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'from' => $this->from,
            'to' => $this->to,
            'author_name' => Auth::user()->name,
            'author_phone' => Auth::user()->phone,
            'status' => $this->statuses?->name,
            'user' => $this->user->name,
            'client' => $this->client->name,
            'time' => $this->time
        ];
    }
}
