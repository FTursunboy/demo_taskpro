<?php

namespace App\Http\Resources\API\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AuthResource extends JsonResource
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
            'surname' => $this->surname,
            'lastname' => $this->lastname,
            'login' => $this->login,
            'phone' => $this->phone,
            'position' => $this->position,
            'email' => $this->email,
            'depart' => $this->otdel->name,
            'xp' => $this->xp,
            'slug' => $this->slug,
            'role' => $this->getRoleNames(),
        ];
    }
}
