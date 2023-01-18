<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/useraddress/create')) {
            return [
                'address' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
            ];
        } else {
            return [
                'address' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
            ];
        }
    }

    public function messages()
    {
        return [
            'address.required' => __('validation.required', ['attribute' => 'user address']),
        ];
    }
}