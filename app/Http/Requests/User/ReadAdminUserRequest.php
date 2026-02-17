<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReadAdminUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('admin')->user()->can('userManagement.read');
    }

    public function rules()
    {
        return [
            'id' => 'sometimes|exists:users,id',
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
        // Accept id from either route or query param
        $id = $this->route('id') ?? $this->query('id');
        if ($id) {
            $this->merge(['id' => $id]);
        }
    }
}
