<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class Savings extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = 'vault';

    protected $with = ['balance:savings_id,available_balance, interest_balance'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function paymyrentSavings()
    {
        return $this->hasMany(PaymyrentMortgageSavings::class);
    }


    public function missedSavings()
    {
        return $this->hasMany(MissedSavings::class);
    }

    public function interests()
    {
        return $this->hasMany(Interest::class);
    }

    public function balance()
    {
        return $this->hasOne(SavingsBalance::class);
    }

    public function paymyrentBalance()
    {
        return $this->hasOne(PaymyrentMortgageSavingsBalance::class);
    }

    public function group()
    {
        return $this->belongsTo(GroupSavings::class);
    }

    public function tenure()
    {
        return $this->belongsTo(Tenure::class);
    }

    public function user()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->whereActive(1)->where('end_date', '>', now());
    }
    public function scopeFrequency($query, $frequency)
    {
        return $query->where('frequency_type', $frequency);
    }

}
