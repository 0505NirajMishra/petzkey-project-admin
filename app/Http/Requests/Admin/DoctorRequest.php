<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/doctor/create')) {
            return [
                'doctor_image' => 'required',
            ];
        } else {
            return [
                'doctor_image' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'doctor_image.required' => __('validation.required', ['attribute' => 'Doctor Image']),
        ];
    }
}