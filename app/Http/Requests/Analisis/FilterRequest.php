<?php

namespace App\Http\Requests\Analisis;

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
            'paciente_id' => [
                'sometimes',
                'integer',
                'exists:'.User::class.',id',
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
