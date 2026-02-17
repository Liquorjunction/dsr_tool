<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateAdminUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('admin')->user()->can('userManagement.edit');
    }

    public function rules(): array
    {
        $id = $this->query('id');
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'phone_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'remarks' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string',
            'profile_image' => 'nullable|image|max:2048',
        ];
    }
}
