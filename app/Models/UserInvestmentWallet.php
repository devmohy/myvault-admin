<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvestmentWallet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $connection = 'vault';

    protected $casts = [
        'balance' => 'decimal:2',
    ];

    protected $encryptable = [
        'balance',
    ];

    public function setBalanceAttribute($value)
    {
        $this->attributes['balance'] = encrypt($value);
    }

    public function setPreviousBalanceAttribute($value)
    {
        $this->attributes['previous_balance'] = encrypt($value);
    }

    public function getBalanceAttribute($value)
    {
        return decrypt($value);
    }

    public function getPreviousBalanceAttribute($value)
    {
        return decrypt($value);
    }

    public function investmentWallet()
    {
        return $this->belongsTo(InvestmentWallet::class);
    }
}
