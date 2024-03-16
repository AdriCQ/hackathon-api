<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnalisisResponse extends JsonResource
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
            'usuario' => new UserResponse($this->whenLoaded('user')),
            'titulo' => $this->titulo,
            'descripcion' => $this->description,
            'fecha_creacion' => $this->created_at,
        ];
    }
}
