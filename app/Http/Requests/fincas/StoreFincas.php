<?php

namespace App\Http\Requests\fincas;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreFincas extends FormRequest
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
            //,Rule::unique('fincas','ruta')->ignore($this->route('finca'))
           'codigo'=>['required'],
            'nombre'=>['required']
/*
            "hlk" => null
            "hlvk" => null
            "cmk" => null
            "cmvk" => null
            "mlk" => null
            "mlvk" => null
            "mck" => null
            "mcvk" => null
            "tk" => null
            "tvk" => null
            "rk" => null
            "rvk" => null
            "nvgv" => null
            "vsgv" => null
            "vpgv" => null
            "radio_1" => null
            "rnvp" => null
            "rnvm" => null
            "rmcp" => null
            "rmcm" => null
            "rtp" => null
            "rtpm" => null
            "cvpac" => "0"
            "vsv" => null
            "vsr" => null
            "avsv" => null
            "avsr" => null
            */
        ];
    }
}
