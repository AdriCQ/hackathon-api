<?php

namespace App\Http\Requests\Media;

use App\Models\Analisis;
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
            'analisis_id' => [
                'sometimes',
                'integer',
                'exists:'.Analisis::class.',id',
            ],
            'order_by' => [
                'sometimes',
                'in:name,phone,id,created_at',
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
            'analisis_id' => [
                'description' => 'ID del analisis',
            ],
            'search' => [
                'description' => 'Criterio de búsqueda',
            ],
            'order_by' => [
                'description' => 'Criterio de ordenamiento',
                'example' => 'name, phone, id, created_at',
            ],
            'paginate' => [
                'description' => 'Cantidad de elementos por página (10 por defecto)',
            ],
        ];
    }
}
