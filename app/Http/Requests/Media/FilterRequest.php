<?php

namespace App\Http\Requests\Media;

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
            'order_by' => [
                'sometimes',
                'in:name,phone,id,created_at',
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
                'example' => 'name, phone, id, created_at',
            ],
            'paginate' => [
                'description' => 'Cantidad de elementos por página (10 por defecto)',
            ],
        ];
    }
}
