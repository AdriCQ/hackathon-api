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
            'nombre' => [
                'required',
                'string',
            ],
            'apellido_paternal' => [
                'required',
                'string',
            ],
            'apellido_maternal' => [
                'required',
                'string',
            ],
            'email' => [
                'nullable',
                'email',
                'unique:'.User::class.',email',
            ],
            'telefono' => [
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
            'nombre' => [
                'description' => 'Nombre de Usuario',
            ],
            'apellido_paternal' => [
                'description' => 'Apellido Paternal',
            ],
            'apellido_maternal' => [
                'description' => 'Apellido Maternal',
            ],
            'password' => [
                'description' => 'Contraseña de usuario',
            ],
            'email' => [
                'description' => 'Email',
                'example' => 'myemail@email.com',
            ],
            'telefono' => [
                'description' => 'Teléfono móvil',
                'example' => '52 XXXX XXXX',
            ],
        ];
    }
}
