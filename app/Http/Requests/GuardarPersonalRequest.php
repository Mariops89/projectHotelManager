<?php

namespace App\Http\Requests;

use App\Models\Personal;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GuardarPersonalRequest extends FormRequest
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
            'dni' => ['nif',
                Rule::unique(Personal::class, 'dni')->ignore($this->id)],
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'telefono' => ['required', 'spanish_phone'],
            'direccion' => ['required'],
            'localidad' => ['required'],
            'cod_postal' => ['required', 'spanish_postal_code'],
            'provincia' => ['required'],
            'pais' => ['required'],
            'tipo' => ['required'],
        ];
    }
}
