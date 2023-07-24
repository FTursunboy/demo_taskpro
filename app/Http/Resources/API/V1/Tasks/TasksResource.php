<?php

namespace App\Http\Resources\API\V1\Tasks;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->file) {
            $filePath = Storage::disk('public')->path($this->file);
            if (file_exists($filePath)) {
                $fileData = file_get_contents($filePath);
                $file = base64_encode($fileData);
            }
        }
        $file = null;
        if ($this->file) {
            $file = url('public' . $this->file);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'time' => $this->time,
            'from' => $this->from,
            'to' => $this->to,
            'type' => $this?->type?->name,
            'kpi' => ($this->typeType === null) ? null : $this->typeType->name,
            'percent' => ($this->percent === null) ? null : $this->percent,
            'comment' => $this->comment,
            'author' => $this->author->surname . ' ' . $this->author->name,
            'project' => $this->project->name,
            'client' => ($this->client === null) ? null : $this->client->surname . ' ' . $this->client->name,
            'status' => $this->status->name,
            'file' => $file,
            'file_name' => $this->file_name,
            'user_id' => $this->user_id,
            'kpd' => $this->checkDate?->count,
            'slug' => $this->slug,
        ];
    }
}
