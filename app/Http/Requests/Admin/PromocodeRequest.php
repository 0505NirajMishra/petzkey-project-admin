<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PromocodeRequest extends FormRequest
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
        if (!request()->is('admin/promocodes/create')) {
            return [
                'promo_name' => 'required',

                'value' => 'required',
                'use_limit' => 'required', //in rs
                  //in rs
                'start_time' => 'required',
                'end_time' => 'required',
                // 'status' => 'required', //1:Open 2:Running
            ];
        } else {
            return [
                'promo_name' => 'required',

                'value' => 'required',
                'use_limit' => 'required', //in rs
                  //in rs
                'start_time' => 'required',
                'end_time' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'promo_name.required' => __('validation.required', ['attribute' => 'Promo Name']),

            'value.required' => __('validation.required', ['attribute' => 'Value']),
            'use_limit.required' => __('validation.required', ['attribute' => 'Limit']),
            'start_time.required' => __('validation.required', ['attribute' => 'Start Time']),
            'end_time.required' => __('validation.required', ['attribute' => 'End Time']),
            // 'status.required' => __('validation.required', ['attribute' => 'status']),
        ];
    }
}
