<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'phone_number' => $this->resource->phone_number,
            'savings_balance' => '₦' . number_format($this->resource->savings_balance, 2, '.', ','),
            'wallet_balance' => '₦' . number_format($this->resource->wallet_balance, 2, '.', ','),
            'interest_balance' => '₦' . number_format($this->resource->interest_balance, 2, '.', ','),
        ];
    }
}
