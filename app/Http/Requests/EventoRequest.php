<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
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
            'nombre' => 'required|max:30',
            'descripcion' => 'required|max:255',
            'imagen' => 'required',
            'limite_usuarios'=> 'required|numeric',
            'fecha_inicio' => 'required',
            'destacado' => 'required|numeric|max:1',
            'destacado_principal' => 'required|numeric|max:1',
        ];
    }
}
