<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TrainerCapacityRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/trainercapacity/create')) {
            return [
                'trainer_apt_cap' => 'required|numeric',
            ];
        } else {
            return [
                'trainer_apt_cap' => 'required|numeric',
            ];
        }
    }

    public function messages()
    {
        return [
            'trainer_apt_cap.required' => __('validation.required', ['attribute' => 'Trainer Capacity']),           
        ];
    }
}