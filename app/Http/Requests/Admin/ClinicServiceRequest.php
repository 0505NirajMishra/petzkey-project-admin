<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClinicServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/clinic/create')) {
            return [
                'pettype' => 'required',
                'clinic_fees' => 'required',
                'home_fees' => 'required',
                'desc' => 'required'
            ];
        } else {
            return [
                'pettype' => 'required',
                'clinic_fees' => 'required',
                'home_fees' => 'required',
                'desc' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'pettype.required' => __('validation.required', ['attribute' => 'Category Name']),
            'clinic_fees.required' => __('validation.required', ['attribute' => 'Clinic Fees']),
            'home_fees.required' => __('validation.required', ['attribute' => 'Clinic Home Fees']),
            'desc.required' => __('validation.required', ['attribute' => 'Clinic Desc']),
        ];
    }
}