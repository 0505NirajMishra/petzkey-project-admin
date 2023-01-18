<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HostelAppoinmentRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/hostelappoinment/create')) {
            return [
                'appt_date_time' => 'required',
                'book_date_time' => 'required',
                'progress_status' => 'required',
                'payment' => 'required'
            ];
        } else {
            return [
                'appt_date_time' => 'required',
                'book_date_time' => 'required',
                'progress_status' => 'required',
                'payment' => 'required' 
            ];
        }
    }

    public function messages()
    {
        return [
            'appt_date_time.required' => __('validation.required', ['attribute' => 'app date time']),
            'book_date_time.required' => __('validation.required', ['attribute' => 'book date time']),
            'progress_status.required' => __('validation.required', ['attribute' => 'progress status']),
            'payment.required' => __('validation.required', ['attribute' => 'payment']),
        ];
    }
}