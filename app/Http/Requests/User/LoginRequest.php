<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'telefono' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
        ];
    }

    /**
     * bodyParameters
     */
    public function bodyParameters()
    {
        return [
            'password' => [
                'description' => 'Contraseña de usuario',
            ],
            'telefono' => [
                'description' => 'Teléfono móvil',
                'example' => '52 XXXX XXXX',
            ],
        ];
    }
}
