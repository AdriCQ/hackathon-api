<?php

namespace App\Http\Requests\Ultrasonido;

use App\Models\User;
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
            'telefono_paciente' => [
                'sometimes',
                'string',
                'exists:'.User::class.',telefono',
            ],
            'order_by' => [
                'sometimes',
                'in:id,created_at',
            ],
            'paginate' => [
                'sometimes',
                'integer',
            ],
            'search' => [
                'sometimes',
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
            'search' => [
                'description' => 'Criterio de búsqueda',
            ],
            'order_by' => [
                'description' => 'Criterio de ordenamiento',
                'example' => 'id, created_at',
            ],
            'paginate' => [
                'description' => 'Cantidad de elementos por página (10 por defecto)',
            ],
        ];
    }
}
