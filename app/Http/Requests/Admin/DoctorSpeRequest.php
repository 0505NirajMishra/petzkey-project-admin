<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorSpeRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/doctorspeciality/create')) {
            return [
                'dr_spclty_name' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
            ];
        } else {
            return [
                'dr_spclty_name' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
            ];
        }
    }

    public function messages()
    {
        return [
            'dr_spclty_name.required' => __('validation.required', ['attribute' => 'Doctor Speciality']),           
        ];
    }
}