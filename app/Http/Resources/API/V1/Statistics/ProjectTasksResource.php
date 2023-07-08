<?php

namespace App\Http\Resources\API\V1\Statistics;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectTasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'count_tasks' => new ProjectTasksResource($this->count_tasks),
            'count_ready' => new ProjectTasksResource($this->count_ready),
            'count_process' => new ProjectTasksResource($this->count_process),
        ];
    }
}
