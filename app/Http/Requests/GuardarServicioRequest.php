<?php

namespace App\Http\Requests;

use App\Models\Servicio;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarServicioRequest extends FormRequest
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
            'nombre' => ['required', 'max:50', Rule::unique(Servicio::class, 'nombre')->ignore($this->id)],
            'estado' => ['required'],
            'plazas' => ['required', 'integer', 'min:0'],
            'precio' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'plazas.min' => 'El número de plazas tiene que ser positivo'
        ];
    }
}
