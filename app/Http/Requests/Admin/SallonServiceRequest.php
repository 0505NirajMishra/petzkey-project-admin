<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SallonServiceRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/sallonservice/create')) {
            return [
                'pettype' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'sallon_servc_name' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'sallon_servc_img' => 'required',
                'sallon_servc_pckgtyp' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'cntr_fee' => 'required|numeric',
                'home_fee' => 'required|numeric',
            ];
        } else {
            return [    
                'pettype' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'sallon_servc_name' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'sallon_servc_img' => 'required',
                'sallon_servc_pckgtyp' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'cntr_fee' => 'required|numeric',
                'home_fee' => 'required|numeric',
            ];
        }
    }

    public function messages()
    {
        return [
            'pettype.required' => __('validation.required', ['attribute' => 'Pet type']),
            'sallon_servc_name.required' => __('validation.required', ['attribute' => 'sallon service type']),
            'sallon_servc_img.required' => __('validation.required', ['attribute' => 'sallon service image']),
            'sallon_servc_pckgtyp.required' => __('validation.required', ['attribute' => 'sallon service packagetype']),
            'cntr_fee.required' => __('validation.required', ['attribute' => 'sallon center fees']),
            'home_fee.required' => __('validation.required', ['attribute' => 'sallon home fees']),
        ];
    }
}