<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserServiceRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/userservicetype/create')) {
            return [
                'service_name' => 'required|string|regex:/^[a-zA-Z]+$/u',
            ];
        } else {
            return [
                'service_name' => 'required|string|regex:/^[a-zA-Z]+$/u',
            ];
        }
    }

    public function messages()
    {
        return [
            'service_name.required' => __('validation.required', ['attribute' => 'service name']),
        ];
    }
}