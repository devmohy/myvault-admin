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

    protected $with = ['balance:savings_id,available_balance'];
    protected $appends = ['duration'];

    public function getDurationAttribute()
    {
        if ($this->start_date && $this->end_date) {
            $start = \Carbon\Carbon::parse($this->start_date);
            $end = \Carbon\Carbon::parse($this->end_date);

            return $start->diffInMonths($end).' Months'; // You can use diffInMonths(), diffInYears(), etc., based on your requirements
        }

        return null;
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'trx_group_id');
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
