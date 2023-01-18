<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TrainerServiceRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/trainerservice/create')) {
            return [
                'pettype' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'trainer_servc_name' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'trainer_servc_img' => 'required',
                'trainer_servc_packagetype' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'cntr_fees' => 'required|numeric',
                'home_fees' => 'required|numeric',
            ];
        } else {
            return [    
                'pettype' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'trainer_servc_name' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'trainer_servc_img' => 'required',
                'trainer_servc_packagetype' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'cntr_fees' => 'required|numeric',
                'home_fees' => 'required|numeric',
            ];
        }
    }

    public function messages()
    {
        return [
            'pettype.required' => __('validation.required', ['attribute' => 'Pet type']),
            'trainer_servc_name.required' => __('validation.required', ['attribute' => 'trainer service type']),
            'trainer_servc_img.required' => __('validation.required', ['attribute' => 'trainer service image']),
            'trainer_servc_packagetype.required' => __('validation.required', ['attribute' => 'trainer service packagetype']),
            'cntr_fees.required' => __('validation.required', ['attribute' => 'trainer center fees']),
            'home_fees.required' => __('validation.required', ['attribute' => 'trainer home fees']),
        ];
    }
}