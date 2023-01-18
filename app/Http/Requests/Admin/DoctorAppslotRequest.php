<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorAppslotRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/doctorappsloat/create')) {
            return [
                'dr_mrg_slot' => 'required|numeric',
                'dr_evg_slot' => 'required|numeric',
            ];
        } else {
            return [
                'dr_mrg_slot' => 'required|numeric',
                'dr_evg_slot' => 'required|numeric',
            ];
        }
    }

    public function messages()
    {
        return [
            'dr_mrg_slot.required' => __('validation.required', ['attribute' => 'doctor mrg slot']),
            'dr_evg_slot.required' => __('validation.required', ['attribute' => 'doctor evg slot']),
        ];
    }
}