<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUsuarios extends FormRequest
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

            'documento' => ['required', 'max:15', Rule::unique('users')->ignore($this->route('usuario'))],
            'nombre' => ['required', 'max:50'],
            'usuario' => ['required', 'max:20'],
            'password' => ['required', 'confirmed', 'min:6'],
            'idcliente' => ['required', 'min:1'],
            'idperfil' => ['required', 'min:1']
        ];
    }

    /* cambiar nombre a atributo
    public function attributes(){
        return [
         
            'codigofinca'=>'Luis torres',
    ];
    } 
    */

    /* mensajes personalizados
    public function messages()
    {
        return [
            'nombrefinca.required'=>'Luis torres',
    ];  
    }
*/
}
