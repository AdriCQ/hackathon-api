<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'phone' => [
                'required',
                'unique:'.User::class.',phone',
                'phone',
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
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
            'name' => [
                'description' => 'Nombre de Usuario',
            ],
            'password' => [
                'description' => 'Contraseña de usuario',
            ],
            'phone' => [
                'description' => 'Teléfono móvil',
                'example' => '52 XXXX XXXX',
            ],
        ];
    }
}
