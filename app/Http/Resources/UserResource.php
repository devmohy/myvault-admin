<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'role' => $this->role,
            'type' => $this->business_id ? 'business' : 'admin',
            'has_verified_email' => $this->when($this->business_id != null, $this->email_verified_at),
            'business' => $this->when($this->business_id != null, $this->business),
            'permissions' => $this->role->permissions->pluck('action')->unique()->values()->all(),
        ];
    }
}
