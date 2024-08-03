<?php

namespace App\Models;

use App\Enum\LoanStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'reference',
        'loan_type_id',
        'business_id',
        'employee_id',
        'created_by',
        'approved_by',
        'approved_at',
        'amount',
        'total_amount_payable',
        'amount_paid',
        'amount_outstanding',
        'salary_deduction_percent',
        'salary_deduction_amount',
        'reason',
        'schedule',
        'tenor',
        'status',
        'external_reference'
    ];

    /**
     * Get the loan type associated with the loan.
     */
    public function loanType(): BelongsTo
    {
        return $this->belongsTo(LoanType::class);
    }

    /**
     * Get the employee associated with the loan.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the business associated with the loan.
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'like', '%' . $searchTerm . '%')->orWhereHas('business', function ($q) use ($searchTerm) {
            $q->whereRaw("business_name LIKE ?", ['%' . $searchTerm . '%']);
        });
    }

    public function scopeActive($query)
    {
        return $query->whereNotIn('status', [LoanStatusEnum::PAID, LoanStatusEnum::REJECTED]);
    }
}
