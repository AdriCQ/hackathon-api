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
            'apellido_paterno' => [
                'required',
                'string',
            ],
            'apellido_materno' => [
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
                'unique:'.User::class.',telefono',
                'string',
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:6',
            ],
            'fecha_nacimiento' => [
                'required',
                'string',
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
            'apellido_paterno' => [
                'description' => 'Apellido Paternal',
            ],
            'apellido_materno' => [
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
