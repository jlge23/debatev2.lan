<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipo extends FormRequest
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
            'nombre' => 'required|unique:equipos,nombre|max:255|regex:/(^([0-9a-zA-zÑñÁÉÍÓÚáéíóú.\' ]+)$)/u',
            'descripcion' => 'required|unique:equipos'
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'Nombre del Equipo',
            'descripcion' => 'Iglesia o lugar de procedencia'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Nombre del Equipo Requerido',
            'nombre.max' => 'Cantidad máxima de caracteres permitidos (512)',
            'nombre.regex' => 'Sólo se permiten caracteres en Mayusculas, minusculas, números y cactacteres .\' y Espacios',
            'nombre.unique' => 'El valor del campo Nombre del Equipo ya está en uso.',
            'descripcion.required' => 'Selecciones la Iglesia o lugar de procedencia'
        ];
    }
}
