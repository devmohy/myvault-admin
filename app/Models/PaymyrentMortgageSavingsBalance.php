<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymyrentMortgageSavingsBalance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $connection = 'vault';
    
    public function savings() {
        return $this->belongsTo(Savings::class);
    }

    public function credit($amount)
    {
        $this->update([
            'available_balance' => $this->available_balance + abs($amount),
            'last_transaction_date' => now(),
            'previous_available_balance' => $this->available_balance
        ]);
        return true;
    }
}
