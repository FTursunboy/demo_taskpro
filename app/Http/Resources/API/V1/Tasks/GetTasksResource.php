<?php

namespace App\Http\Resources\API\V1\Tasks;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetTasksResource extends JsonResource
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
            'time' => $this->time,
            'from' => $this->from,
            'to' => $this->to,
            'type' => $this->type->name,
            'kpi' => ($this->typeType === null) ? null : $this->typeType->name,
            'percent' => ($this->percent === null) ? null : $this->percent,
            'comment' => $this->comment,
            'author' => $this->author->surname . ' ' . $this->author->name,
            'project' => $this->project->name,
            'client' => ($this->client === null) ? null : $this->client->surname . ' ' . $this->client->name,
            'status' => $this->status->name,
            'slug' => $this->slug,
        ];
    }
}
