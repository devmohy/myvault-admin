<?php

namespace App\Http\Resources;

use DateTime;
use App\Models\Transaction;
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
        $interest = Transaction::where('trx_group_id', $this->id)->where('trx_group', 'savings')->where('payment_type', 'interest')->sum('amount');
        return [
            'id' => $this->id,
            'reference' => $this->reference,
            'name' => $this->title,
            'amount' => number_format($this->frequent_amount, 2, '.', ','),
            'balance' => number_format($this->balance->available_balance, 2, '.', ','),
            'interest' => number_format($interest, 2, '.', ','),
            'customer_name' => optional($this->user)->name,
            'customer_phone_number' => optional($this->user)->phone_number,
            'customer_email' => optional($this->user)->email,
            'status' => $this->status,
            'active' => $this->active,
            'date' => $this->created_at->format('F d, Y @ h:iA'),   
        ];
    }
}
