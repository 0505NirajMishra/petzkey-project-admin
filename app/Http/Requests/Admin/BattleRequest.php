<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BattleRequest extends FormRequest
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
        if (!request()->is('admin/battles/create')) {
            return [
                'total_player' => 'required|numeric|min:2|lte:6',

                'room_no' => 'required|unique:battles,room_no,' . request()->id,
                'entry_fee' => 'required', //in rs
                'prize' => 'required',  //in rs
                'start_time' => 'required',
                // 'status' => 'required', //1:Open 2:Running
            ];
        } else {
            return [
                'total_player' => 'required|numeric|min:2|lte:6',

                'room_no' => 'required|unique:battles,room_no,',
                'entry_fee' => 'required', //in rs
                'prize' => 'required',  //in rs
                'start_time' => 'required',
                // 'status' => 'required', //1:Open 2:Running
            ];
        }
    }

    public function messages()
    {
        return [
            'total_player.required' => __('validation.required', ['attribute' => 'Total Player']),

            'room_no.required' => __('validation.required', ['attribute' => 'room_no']),
            'entry_fee.required' => __('validation.required', ['attribute' => 'entry_fee']),
            'prize.required' => __('validation.required', ['attribute' => 'prize']),
            'start_time.required' => __('validation.required', ['attribute' => 'start_time']),
            'status.required' => __('validation.required', ['attribute' => 'status']),
        ];
    }
}
