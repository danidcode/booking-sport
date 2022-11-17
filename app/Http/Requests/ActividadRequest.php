<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActividadRequest extends FormRequest
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
            'nombre' => 'required|max:20',
            'descripcion' => 'required|max:255',
            'imagen' => 'required',
            'limite_usuarios'=> 'required|numeric',
            'dias_activo' => 'required',
            'destacado' => 'required|numeric|max:1',
            'activo' => 'required|numeric|max:1',
        ];
    }
}
