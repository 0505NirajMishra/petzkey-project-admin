<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SallonImageRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/sallonimage/create')) {
            return [
                'sallon_img' => 'required',
            ];
        } else {
            return [
                'sallon_img' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'sallon_img.required' => __('validation.required', ['attribute' => 'Sallon image']),           
        ];
    }
}