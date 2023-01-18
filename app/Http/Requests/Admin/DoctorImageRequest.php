<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorImageRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/doctorimage/create')) {
            return [
                'clinic_img' => 'required',
            ];
        } else {
            return [
                'clinic_img' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'clinic_img.required' => __('validation.required', ['attribute' => 'Clinic image']),
        ];
    }
}