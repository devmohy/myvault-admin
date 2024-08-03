<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z-]+$/'],
            'last_name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z-]+$/'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:200', 'unique:businesses,email'],
            'phone_number' => ['required', 'string', 'max:18', 'unique:businesses,phone_number'],
            'business_name' => ['required', 'string', 'max:200', 'unique:businesses,business_name'],
            'rc_number' => ['required', 'string', 'max:10', 'unique:businesses,rc_number'],
            'business_type' => ['required', 'string'],
            'password' => ['required', 'string','max:150'],
        ];
    }
}
