<?php

namespace App\Http\Requests\Analisis;

use App\Models\User;
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
            'paciente_id' => [
                'required',
                'integer',
                'exists:'.User::class.',id',
            ],
            'titulo' => [
                'required',
                'string',
            ],
            'descripcion' => [
                'nullable',
                'string',
            ],
        ];
    }
}
