<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PetDetailRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        if (!request()->is('admin/petdetail/create')) {
            return [
                'pet_type' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'pet_breed' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'pet_gender' => 'required',
                'pet_height' => 'required|string',
                'pet_year' => 'required|numeric',
                'pet_month' => 'required|numeric',
                'pet_weight' => 'required|string',
                'pet_image' => 'required'
            ];
        } else {
            return [
                'pet_type' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'pet_breed' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255',
                'pet_gender' => 'required',
                'pet_year' => 'required|numeric',
                'pet_month' => 'required|numeric',
                'pet_height' => 'required|string', 
                'pet_weight' => 'required|string',
                'pet_image' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'pet_type.required' => __('validation.required', ['attribute' => 'Pet Type']),
            'pet_breed.required' => __('validation.required', ['attribute' => 'Pet Breed']),
            'pet_gender.required' => __('validation.required', ['attribute' => 'Pet Gender']),
            'pet_height.required' => __('validation.required', ['attribute' => 'Pet Height']),
            'pet_year.required' => __('validation.required', ['attribute' => 'Pet Year']),
            'pet_month.required' => __('validation.required', ['attribute' => 'Pet Month']),
            'pet_weight.required' => __('validation.required', ['attribute' => 'Pet Weight']),
            'pet_image.required' => __('validation.required', ['attribute' => 'Pet Image']),
        ];
    }
}