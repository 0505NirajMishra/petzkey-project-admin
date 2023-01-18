<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TrainerApptslotRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (!request()->is('admin/trainerapptslot/create')) {
            return [
                'trainer_mrg_slot' => 'required|numeric',
                'trainer_evg_slot' => 'required|numeric',
            ];
        } else {
            return [
                'trainer_mrg_slot' => 'required|numeric',
                'trainer_evg_slot' => 'required|numeric',
            ];
        }
    }

    public function messages()
    {
        return [
            'trainer_mrg_slot.required' => __('validation.required', ['attribute' => 'Trainer mrg slot']),           
            'trainer_evg_slot.required' => __('validation.required', ['attribute' => 'Trainer evg slot']),                      
        ];
    }
}