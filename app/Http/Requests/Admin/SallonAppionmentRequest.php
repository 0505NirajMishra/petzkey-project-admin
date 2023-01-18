<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SallonAppionmentRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/sallonappoinment/create')) {
            return [
                'appt_date_time' => 'required',
                'book_date_time' => 'required',
                'progress_status' => 'required',
                'payment' => 'required|numeric',
            ];
        } else {
            return [
                'appt_date_time' => 'required',
                'book_date_time' => 'required',
                'progress_status' => 'required',
                'payment' => 'required|numeric',
            ];
        }
    }

    public function messages()
    {
        return [
            'appt_date_time.required' => __('validation.required', ['attribute' => 'Sallon mrg slot']),           
            'book_date_time.required' => __('validation.required', ['attribute' => 'Sallon evg slot']),
            'progress_status.required' => __('validation.required', ['attribute' => 'Sallon evg slot']),                      
            'payment.required' => __('validation.required', ['attribute' => 'Sallon evg slot']),
        ];
    }
}