<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido_paternal' => $this->apellido_paternal,
            'apellido_maternal' => $this->apellido_maternal,
            'telefono' => $this->telefono,
            'email' => $this->email,
        ];
    }
}
