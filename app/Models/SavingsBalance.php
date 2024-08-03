<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsBalance extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = 'vault';

    protected $cast =[
        'available_balance' => 'float',
        'previous_available_balance' => 'float',
        'booked_balance' => 'float',
    ];


    public function savings() {
        return $this->belongsTo(Savings::class);
    }

    public function credit($amount)
    {
        $this->available_balance = $this->available_balance + abs($amount);
        $this->last_transaction_date = now();
        $this->previous_available_balance = $this->available_balance;
        $this->save();
        return true;
    }

    public function debit($amount)
    {
        $this->available_balance = $this->available_balance + abs($amount);
        $this->last_transaction_date = now();
        $this->previous_available_balance = $this->available_balance;
        $this->save();
        return true;
    }
}
