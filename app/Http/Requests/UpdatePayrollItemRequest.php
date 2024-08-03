<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayrollItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "amount_disbursed" => "required|numeric|min:1",
            "sms_email_fee" => "required|numeric|min:0",
            "employees_loan_amount" => "required",
            "amount_to_fund" => "required|numeric|min:1",
            "payroll_id" => ['required'],
            'payroll_items' => ['required', 'array'],
            'payroll_items.*.id' => ['required', 'exists:employees,id'],
            'payroll_items.*.salary' => ['required'],
            'payroll_items.*.loan_amount' => ['required'],
            'payroll_items.*.net_payment' => ['required'],
        ];
    }
}
