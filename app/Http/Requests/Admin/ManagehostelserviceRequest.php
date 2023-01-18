<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ManagehostelserviceRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        if (!request()->is('admin/managehostel/create')) {
            return [
                'opening_time' => 'required',
                'closing_time' => 'required',
                'pet_type' => 'required',
                'pet_per_hour' => 'required', 
                'pet_per_day' => 'required',
                'pet_seat' => 'required',
                'pet_desc' => 'required',
                'pet_image' => 'required',
            ];
        } else {
            return [
                'opening_time' => 'required',
                'closing_time' => 'required',
                'pet_type' => 'required',
                'pet_per_hour' => 'required', 
                'pet_per_day' => 'required',
                'pet_seat' => 'required',
                'pet_desc' => 'required',
                'pet_image' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'opening_time.required' => __('validation.required', ['attribute' => 'Opening Time']),
            'closing_time.required' => __('validation.required', ['attribute' => 'Closing Time']),
            'pet_type.required' => __('validation.required', ['attribute' => 'Pet Type']),
            'pet_per_hour.required' => __('validation.required', ['attribute' => 'Pet Per hour']),
            'pet_per_day.required' => __('validation.required', ['attribute' => 'Pet Per day']),
            'pet_seat.required' => __('validation.required', ['attribute' => 'Pet Seat']),
            'pet_desc.required' => __('validation.required', ['attribute' => 'Pet Description']),
            'pet_image.required' => __('validation.required', ['attribute' => 'Pet Image']),
        ];
    }
}