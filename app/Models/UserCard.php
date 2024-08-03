<?php

namespace App\Models;

use App\Exceptions\PaystackServiceException;
use App\Services\Paystack;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Throwable;

class UserCard extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $connection = 'vault';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class, 'card_id');
    }
}
