<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HostelProfileRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/hostleprofile/create')) {
            return [
                'hostel_image' => 'required',
            ];
        } else {
            return [
                'hostel_image' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'hostel_image.required' => __('validation.required', ['attribute' => 'Hostel Image']),
        ];
    }
}