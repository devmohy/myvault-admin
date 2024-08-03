<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'type' => $this->type,
            'group' => $this->trx_group,
            'category' => $this->payment_type,
            'amount' => number_format($this->amount, 2, '.', ','),
            'narration' => $this->narration,
            'user_name' => optional($this->user)->name,
            'phone_number' => optional($this->user)->phone_number,
            'status' => $this->transaction_status,
            'date' => $this->created_at->format('F d, Y @ h:iA'),   
        ];
    }
}
