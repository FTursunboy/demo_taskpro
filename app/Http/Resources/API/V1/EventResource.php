<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'description' => $this->description,
            'date' => $this->date,
            'type_event' => $this->typeEvent->name,
            'theme_event' => $this->themeEvent->theme,
            'event_status' => $this->eventStatus->name,
        ];
    }
}
