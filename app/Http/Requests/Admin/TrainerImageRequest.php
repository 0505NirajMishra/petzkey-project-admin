<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TrainerImageRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/trainerimage/create')) {
            return [
                'trainer_image' => 'required',
            ];
        } else {
            return [
                'trainer_image' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'trainer_image.required' => __('validation.required', ['attribute' => 'Trainer Image']),           
        ];
    }
}