<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tenure',
        'eligible_percent_in_salary_gross',
        'deduction_percent_monthly'
    ];
}
