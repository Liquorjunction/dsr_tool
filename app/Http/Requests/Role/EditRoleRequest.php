<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditRoleRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::guard('admin')->user()->can('role.edit');
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:roles,id',
        ];
    }
}
