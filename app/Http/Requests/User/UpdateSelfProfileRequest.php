<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSelfProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('admin')->user()->can('user.update');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route('id'),
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'remarks' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|max:2048',
        ];
    }
}
