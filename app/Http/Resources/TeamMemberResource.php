<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamMemberResource extends JsonResource
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
            'member_name' => "$this->first_name $this->last_name",
            "email" => $this->email,
            "status" => $this->status,
            "role" => optional($this->role)->name,
            "role_id" => $this->role->id,
            'permissions' => $this->role->permissions,
            "last_active" => $this->last_active
        ];
    }
}
