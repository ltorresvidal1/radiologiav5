<?php

namespace App\Http\Requests\medicos;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMedicos extends FormRequest
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
            'documento' => ['required'],
            'nombre' => ['required'],
            'registromedico' => 'required',
            'usuario' => ['required', 'max:20'],
            'password' => ['required', 'confirmed', 'min:6'],
        ];
    }
}
