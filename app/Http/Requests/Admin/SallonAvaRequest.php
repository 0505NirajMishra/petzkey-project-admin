<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SallonAvaRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/sallonavailbilty/create')) {
            return [
                'avail_days' => 'required',
                'ms_opening_time' => 'required',
                'ms_closing_time' => 'required',
                'es_opening_time' => 'required',
                'es_closing_time' => 'required',
            ];
        } else {
            return [
                'avail_days' => 'required',
                'ms_opening_time' => 'required',
                'ms_closing_time' => 'required',
                'es_opening_time' => 'required',
                'es_closing_time' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'avail_days.required' => __('validation.required', ['attribute' => 'Availbilty']),
            'ms_opening_time.required' => __('validation.required', ['attribute' => 'Morning Opening Time']),
            'ms_closing_time.required' => __('validation.required', ['attribute' => 'Morning Closing Time']),
            'es_opening_time.required' => __('validation.required', ['attribute' => 'Evening Opening Time']),
            'es_closing_time.required' => __('validation.required', ['attribute' => 'Evening Closing Time']),                
        ];
    }
}