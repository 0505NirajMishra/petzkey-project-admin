<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HostelAvaRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/HostelAvailbilty/create')) {
            return [
                'opening_time' => 'required',
                'closing_time' => 'required',
            ];
        } else {
            return [
                'opening_time' => 'required',
                'closing_time' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'opening_time.required' => __('validation.required', ['attribute' => 'Opening Time']),
            'closing_time.required' => __('validation.required', ['attribute' => 'Closing Time']),           
        ];
    }
}