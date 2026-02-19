<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DestroyRoleRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::guard('admin')->user()->can('role.delete');
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:roles,id',
        ];
    }

    protected function prepareForValidation()
    {
        $id = $this->input('id') ?? $this->query('id') ?? $this->route('id');
        $this->merge([
            'id' => $id,
        ]);
    }
}
