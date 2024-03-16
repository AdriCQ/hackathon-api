<?php

namespace App\Http\Requests\Analisis;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => [
                'sometimes',
                'string',
            ],
            'descripcion' => [
                'sometimes',
                'string',
            ],
        ];
    }
}
