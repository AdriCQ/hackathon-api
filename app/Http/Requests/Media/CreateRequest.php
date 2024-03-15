<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'description' => [
                'required',
                'string',
            ],
            'image' => [
                'sometimes',
                'image',
            ],
            'video' => [
                'sometimes',
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
            'name' => [
                'description' => 'Título para el registro',
            ],
            'description' => [
                'description' => 'Descripción del contenido o comentarios',
            ],
            'image' => [
                'description' => 'Fichero de tipo Imagen a almacenar',
            ],
            'video' => [
                'description' => 'Fichero de tipo Video a almacenar',
            ],
        ];
    }
}