<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Bank;
use App\Models\Employee;

class BankDetails extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = ['bank_id','account_name', 'account_number', 'business_id', 'employee_id'];

    /**
     * Get the bank associated with the bank details.
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

     /**
     * Get the employee that owns the bank details.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
