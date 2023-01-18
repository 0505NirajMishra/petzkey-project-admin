<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorAppoinmentRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/doctorappoinment/create')) {
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
            'appt_date_time.required' => __('validation.required', ['attribute' => 'appoinment date and time']),
            'book_date_time.required' => __('validation.required', ['attribute' => 'book date and time']),
            'progress_status.required' => __('validation.required', ['attribute' => 'progress status']),
            'payment.required' => __('validation.required', ['attribute' => 'payment']),
        ];
    }
}