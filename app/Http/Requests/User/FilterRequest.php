<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
                'sometimes',
                'string',
            ],
            'order_by' => [
                'sometimes',
                'in:name,phone,id,created_at',
            ],
            'phone' => [
                'sometimes',
                'phone',
            ],
            'paginate' => [
                'sometimes',
                'integer',
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
            'order_by' => [
                'description' => 'Criterio de ordenamiento',
                'example' => 'name, phone, id, created_at',
            ],
            'paginate' => [
                'description' => 'Cantidad de elementos por página (10 por defecto)',
            ],
            'phone' => [
                'description' => 'Teléfono móvil',
                'example' => '52 XXXX XXXX',
            ],
        ];
    }
}
