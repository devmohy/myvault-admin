<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessVirtualAccount extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = ['bank_id','account_name', 'account_number', 'business_id', 'pool_account'];

    /**
     * Get the bank associated with the bank details.
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

     /**
     * Get the business that owns the bank details.
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
