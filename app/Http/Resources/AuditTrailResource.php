<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function PHPUnit\Framework\isEmpty;

class AuditTrailResource extends JsonResource
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
            'user_id' => $this->user_id,
            'event_type' => $this->event_type,
            'description' => $this->description,
            'business_id' => $this->business_id,
            'date_created' => $this->created_at->format('d/m/Y @ h:iA'),
            'team_member' => $this->whenLoaded('user', isset($this->user->first_name) ? ($this->user->first_name.' '.$this->user->last_name) : '')
        ];
    }
}
