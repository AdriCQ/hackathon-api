<?php

namespace App\Http\Requests\Ultrasonido;

use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'secret' => [
                'required',
                'string',
                'min:4',
            ],
        ];
    }

    /**
     * bodyParameters
     */
    public function bodyParameters()
    {
        return [
            'secret' => [
                'description' => 'Código secreto del análisis',
            ],
        ];
    }
}
