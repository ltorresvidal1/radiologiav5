<?php

namespace App\Http\Requests\ris;

use Illuminate\Foundation\Http\FormRequest;

class Storeris_pacientes extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'idtipoid' => ['required', 'not_in:0'],
            'documento' => ['required'],
            'primernombre' => 'required',
            'primerapellido' => 'required',
            'fechanacimiento' => 'required',
            'idsexo' => ['required', 'not_in:0'],
            'celular' => 'required'
        ];
    }
}
