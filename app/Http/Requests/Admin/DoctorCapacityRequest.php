<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorCapacityRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/doctorcapacity/create')) {
            return [
                'dr_apt_cap' => 'required|numeric',
            ];
        } else {
            return [
                'dr_apt_cap' => 'required|numeric',
            ];
        }
    }

    public function messages()
    {
        return [
            'dr_apt_cap.required' => __('validation.required', ['attribute' => 'doctor appoinment capacity']),
        ];
    }
}