<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GuardarClienteRequest extends FormRequest
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
            'dni' => Str::upper($this->dni),
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
            'dni' => ['required', 'min:9', 'max:9', 'nif',
                Rule::unique(Cliente::class, 'dni')->ignore($this->id)],
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'telefono' => ['required', 'numeric', 'min:100000000', 'max:999999999'],
            'direccion' => ['required'],
            'localidad' => ['required'],
            'cod_postal' => ['required', 'numeric', 'min:10000', 'max:99999'],
            'provincia' => ['required'],
            'pais' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'telefono.min' => 'El número de teléfono debe tener 9 dígitos',
            'telefono.max' => 'El número de teléfono debe tener 9 dígitos',
            'telefono.numeric' => 'El teléfono debe ser un número',
            'cod_postal.min' => 'El código postal debe tener 5 dígitos',
            'cod_postal.max' => 'El código postal debe tener 5 dígitos',
            'cod_postal.numeric' => 'El código postal debe ser un número',
            'dni.min' => 'El DNI debe tener 9 dígitos',
            'dni.max' => 'El DNI debe tener 9 dígitos',
            'dni.ends_with' => 'Escriba la letra del DNI'
        ];
    }
}
