<?php

namespace App\Models;

use Throwable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletBalance extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = 'vault';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function debit($amount)
    {
        try {
            $this->update([
                'available_balance' => $this->available_balance - abs($amount),
                'last_transaction_date' => now(),
                'previous_available_balance' => $this->available_balance
            ]);
        } catch (Throwable $e) {
            logger('Wallet: ' . $e->getMessage());
            return false;
        }
        return true;
    }

    public function scopeWallet($query, string $walletType)
    {
        return $query->where('wallet_id', Wallet::where('type', $walletType)->first()->id);
    }
}
