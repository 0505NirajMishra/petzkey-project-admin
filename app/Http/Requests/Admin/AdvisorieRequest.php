<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdvisorieRequest extends FormRequest
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
        if (!request()->is('admin/advisories/create')) {
            return [
                'name' => 'required',
                'status' => 'required', //in rs
                // 'icon' => 'required',  //in rs
                // 'status' => 'required', //1:Open 2:Running
            ];
        } else {
            return [
                'name' => 'required',
                'status' => 'required', //in rs
                // 'icon' => 'required',  //in rs
             
                // 'status' => 'required', //1:Open 2:Running
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'Name']),
            'status.required' => __('validation.required', ['attribute' => 'Status']),
            // 'icon.required' => __('validation.required', ['attribute' => 'Icon']),
        ];
    }
}
