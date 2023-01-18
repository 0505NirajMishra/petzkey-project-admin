<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookAnAppointmentRequest extends FormRequest
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
        if (!request()->is('admin/bookanappointments/create')) {
            return [
                'date' => 'required',

                'start_time' => 'required',
                'end_time' => 'required', //in rs
                'package_id' => 'required',  //in rs
                'vat_no' => 'required',
                'promocode' => 'required',
                'promo_id' => 'required',
                
                // 'status' => 'required', //1:Open 2:Running
            ];
        } else {
            return [
                'date' => 'required',

                'start_time' => 'required',
                'end_time' => 'required', //in rs
                'package_id' => 'required',  //in rs
                'vat_no' => 'required',
                'promocode' => 'required',
                'promo_id' => 'required', //in rs
                
            ];
        }
    }

    public function messages()
    {
        return [
            'date.required' => __('validation.required', ['attribute' => 'Date']),

            'start_time.required' => __('validation.required', ['attribute' => 'Start Time']),
            'end_time.required' => __('validation.required', ['attribute' => 'End Time']),
            'package_id.required' => __('validation.required', ['attribute' => 'Package Id']),
            'vat_no.required' => __('validation.required', ['attribute' => 'Vat No']),
            'promocode.required' => __('validation.required', ['attribute' => 'Promocode']),
            'promo_id.required' => __('validation.required', ['attribute' => 'Promo Id']),
          
        ];
    }
}
