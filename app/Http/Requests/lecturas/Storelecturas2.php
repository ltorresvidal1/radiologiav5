<?php

namespace App\Http\Requests\lecturas;

use Illuminate\Foundation\Http\FormRequest;

class Storelecturas2 extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'estudio2'=>['required'],
            'fechaestudio2'=>['required'],
            'informe2'=>['required'],
        ];
    }
}
