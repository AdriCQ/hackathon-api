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
}
