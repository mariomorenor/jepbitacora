<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReporteRequest extends FormRequest
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
        return [
            'hora_1'=>'required|numeric|min:0|max:23',
            'minuto_1'=>'required|numeric|min:0|max:59',
            'hora_2'=>'required_if:marc_2_check,"on"|numeric|min:0|max:23',
            'minuto_2'=>'required_if:marc_2_check,"on"|numeric|min:0|max:59',
        ];
    }
}
