<?php

namespace App\Http\Requests;

use App\Models\Habitacion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarHabitacionRequest extends FormRequest
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
            'numero' => ['required', 'numeric', 'min:1', Rule::unique(Habitacion::class, 'numero')->ignore($this->id)],
            'id_tipo_habitacion' => ['required'],
            'personas' => ['required', 'numeric', 'min:1'],
            'estado' => ['required'],
        ];
    }


    public function attributes()
    {
        return [
            'numero' => 'número'
        ];
    }


    public function messages()
    {
        return [
            'personas.numeric' => 'Debe ser un número',
            'personas.min' => 'Debe ser un número mayor que 0',
            'numero.numeric' => 'Debe ser un número',
            'numero.min' => 'Debe ser un número mayor que 0',
        ];
    }
}
