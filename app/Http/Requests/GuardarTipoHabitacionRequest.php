<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarTipoHabitacionRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'precio_alta' => round($this->precio_alta, 2),
            'precio_baja' => round($this->precio_baja, 2),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo' => ['required'],
            'precio_alta' => ['required', 'numeric', 'min:0'],
            'precio_baja' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'precio_alta.numeric' => 'El precio debe ser numérico',
            'precio_alta.min' => 'El precio debe ser mayor que 0',
            'precio_baja.numeric' => 'El precio debe ser numérico',
            'precio_baja.min' => 'El precio debe ser mayor que 0',
        ];
    }
}
