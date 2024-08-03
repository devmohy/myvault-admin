<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'assignees' => $this->users->count(),
            'status' => $this->status,
            'date_created' => $this->created_at->format('d/m/Y @ h:iA'),
            'permissions' => $this->whenLoaded('permissions', $this->permissions),
            'members' => $this->whenLoaded('users', $this->users)
        ];
    }
}
