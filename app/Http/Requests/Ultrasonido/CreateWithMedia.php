<?php

namespace App\Http\Requests\Ultrasonido;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateWithMedia extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'telefono_paciente' => [
                'required',
                'integer',
                'exists:'.User::class.',telefono',
            ],
            'titulo' => [
                'required',
                'string',
            ],
            'descripcion' => [
                'nullable',
                'string',
            ],
            'images' => [
                'sometimes',
                'array',
            ],
            'images.*' => [
                'required',
                'image',
            ],
            'videos' => [
                'sometimes',
                'array',
            ],
            'videos.*' => [
                'required',
                'file',
                'mimetypes:video/*',
            ],
        ];
    }

    /**
     * bodyParameters
     */
    public function bodyParameters()
    {
        return [
            'telefono_paciente' => [
                'description' => 'Teléfono del paciente',
            ],
            'titulo' => [
                'description' => 'Título para el registro',
            ],
            'descripcion' => [
                'description' => 'Descripción del contenido o comentarios',
            ],
            'images' => [
                'description' => 'Conjunto de imágenes',
            ],
            'videos' => [
                'description' => 'Conjunto de videos',
            ],
        ];
    }
}
