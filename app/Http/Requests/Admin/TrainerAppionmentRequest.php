<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TrainerAppionmentRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/trainerappoinment/create')) {
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
            'appt_date_time.required' => __('validation.required', ['attribute' => 'Trainer mrg slot']),           
            'book_date_time.required' => __('validation.required', ['attribute' => 'Trainer evg slot']),
            'progress_status.required' => __('validation.required', ['attribute' => 'Trainer evg slot']),                      
            'payment.required' => __('validation.required', ['attribute' => 'Trainer evg slot']),
        ];
    }
}