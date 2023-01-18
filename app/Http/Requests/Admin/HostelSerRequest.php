<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HostelSerRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/HostelSer/create')) {
            return [
                'pettype' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'hrs_fee' => 'required|numeric',
                'day_fee' => 'required|numeric',
                'hos_seat' => 'required|numeric',
                'desc' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
            ];
        } else {
            return [    
                'pettype' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'hrs_fee' => 'required|numeric',
                'day_fee' => 'required|numeric',
                'hos_seat' => 'required|numeric',
                'desc' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
            ];
        }
    }

    public function messages()
    {
        return [
            'pettype.required' => __('validation.required', ['attribute' => 'Pet type']),
            'hrs_fee.required' => __('validation.required', ['attribute' => 'hour fees']),
            'day_fee.required' => __('validation.required', ['attribute' => 'day fees']),
            'hos_seat.required' => __('validation.required', ['attribute' => 'hostel seat']),
            'desc.required' => __('validation.required', ['attribute' => 'desc']),
        ];
    }
}