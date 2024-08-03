<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetailsResource extends JsonResource
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
            'employee_details' => $this->whenLoaded('employee', new EmployeeResource($this->employee)),
            'payroll_name' => optional($this->payroll)->name,
            'cycle_starts' => optional($this->payroll)->cycle_starts,
            'business_name' => optional($this->business)->business_name,
            'rc_number' => optional($this->business)->rc_number,
            'business_type' => optional($this->business)->business_type,
            'amount' => number_format($this->amount, 2, '.', ','),
            'narration' => $this->narration,
            'status' => $this->status,
            'date' => $this->created_at->format('d/m/Y @ h:iA'),   
        ];
    }
}
