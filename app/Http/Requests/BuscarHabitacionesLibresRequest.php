<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class BuscarHabitacionesLibresRequest extends FormRequest
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

    public function prepareForValidation()
    {
        $fechas = explode(' - ', $this->fechas);
        $this->merge([
            'fecha_entrada' => Carbon::createFromFormat('d/m/Y', $fechas[0])->toDateString(),
            'fecha_salida' => Carbon::createFromFormat('d/m/Y', $fechas[1])->toDateString(),
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
            'fechas' => ['required'],
            'fecha_entrada' => ['required', 'date'],
            'fecha_salida' => ['required', 'date'],
            'idTipoHabitacion' => ['nullable', 'array'],
            'personas' => ['required'],
        ];
    }
}
