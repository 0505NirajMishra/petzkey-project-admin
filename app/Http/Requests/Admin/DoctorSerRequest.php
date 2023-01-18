<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorSerRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/doctorservice/create')) {
            return [
                'pettype' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'clinic_fee' => 'required|numeric',
                'home_fee' => 'required|numeric',
                'desc' =>'required|string|regex:/^[a-zA-Z]+$/u|max:255',
            ];
        } else {
            return [
                'pettype' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'clinic_fee' => 'required|numeric',
                'home_fee' => 'required|numeric',
                'desc' =>'required|string|regex:/^[a-zA-Z]+$/u|max:255',
            ];
        }
    }

    public function messages()
    {
        return [
            'pettype.required' => __('validation.required', ['attribute' => 'Pettype']),
            'clinic_fee.required' => __('validation.required', ['attribute' => 'Clinic fee']),
            'home_fee.required' => __('validation.required', ['attribute' => 'Home fee']),
            'desc.required' => __('validation.required', ['attribute' => 'Desc']),
        ];
    }
}