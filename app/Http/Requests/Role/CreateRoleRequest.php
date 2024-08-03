<?php

namespace App\Http\Requests\Role;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
        $businessId = $this->user()->business_id;
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('roles')->where(function ($query) use ($businessId) {
                    return $query->where('business_id', $businessId);
                }),
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'description' => ['required', 'string'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', 'exists:permissions,id']
        ];
    }
}
