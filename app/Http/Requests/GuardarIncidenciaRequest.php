<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarIncidenciaRequest extends FormRequest
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
            'tipo' => ['required'],
            'descripcion' => ['required'],
            'detalles' => [],
            'acciones' => ['required'],
            'fecha_notificacion' => [],
            'fecha_resolucion' => [],
        ];
    }
}
