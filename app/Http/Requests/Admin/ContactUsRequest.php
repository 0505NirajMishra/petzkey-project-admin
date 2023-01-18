<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (!request()->is('admin/contactus/create')) {
            return [
                'user_name' => 'required',
                'phone' => 'required',
                'gender' => 'required',
                'messages' => 'required',

                
            ];
        } else {
            return [
                'user_name' => 'required',
                'phone' => 'required',
                'gender' => 'required',
                'messages' => 'required',

            ];
        }
    }

    public function messages()
    {
        return [
            'user_name.required' => __('validation.required', ['attribute' => 'User Name']),
            'phone.required' => __('validation.required', ['attribute' => 'Phone']),
            'gender.required' => __('validation.required', ['attribute' => 'Gender']),
            'messages.required' => __('validation.required', ['attribute' => 'Message']),

          
        ];
    }
}
