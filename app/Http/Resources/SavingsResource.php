<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SavingsResource extends JsonResource
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
            'reference' => $this->reference,
            'name' => $this->title,
            'amount' => number_format($this->frequent_amount, 2, '.', ','),
            'balance' => number_format($this->balance->available_balance, 2, '.', ','),
            'interest' => number_format($this->balance->interest_balance, 2, '.', ','),
            'customer_name' => optional($this->user)->name,
            'customer_phone_number' => optional($this->user)->phone_number,
            'customer_email' => optional($this->user)->email,
            'status' => $this->status,
            'active' => $this->active,
            'date' => $this->created_at->format('F d, Y @ h:iA'),   
        ];
    }
}
