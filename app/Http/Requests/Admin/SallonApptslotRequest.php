<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SallonApptslotRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/sallonapptslot/create')) {
            return [
                'sallon_mrg_slot' => 'required|numeric',
                'sallon_evg_slot' => 'required|numeric',
            ];
        } else {
            return [
                'sallon_mrg_slot' => 'required|numeric',
                'sallon_evg_slot' => 'required|numeric',
            ];
        }
    }

    public function messages()
    {
        return [
            'sallon_mrg_slot.required' => __('validation.required', ['attribute' => 'Sallon mrg slot']),           
            'sallon_evg_slot.required' => __('validation.required', ['attribute' => 'Sallon evg slot']),                      
        ];
    }
}