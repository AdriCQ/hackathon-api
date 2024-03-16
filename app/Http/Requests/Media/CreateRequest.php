<?php

namespace App\Http\Requests\Media;

use App\Models\Analisis;
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
            'analisis_id' => [
                'required',
                'integer',
                'exists:'.Analisis::class.',id',
            ],
            'titulo' => [
                'nullable',
                'string',
            ],
            'descripcion' => [
                'nullable',
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
            'analisis_id' => [
                'description' => 'ID del analisis',
            ],
            'titulo' => [
                'description' => 'Título para el registro',
            ],
            'descripcion' => [
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
