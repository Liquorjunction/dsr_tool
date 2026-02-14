<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditAdminUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('admin')->user()->can('userManagement.update');
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'User ID is required.',
            'id.exists' => 'The specified user does not exist.',
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'User ID',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
