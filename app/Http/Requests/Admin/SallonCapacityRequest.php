<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SallonCapacityRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/salloncapacity/create')) 
        {
            return [
                'sallon_apt_cap' => 'required|numeric',
            ];
        } else {
            return [
                'sallon_apt_cap' => 'required|numeric',
            ];
        }
    }

    public function messages()
    {
        return [
            'sallon_apt_cap.required' => __('validation.required', ['attribute' => 'Sallon Appt Capacity']),                      
        ];
    }
}