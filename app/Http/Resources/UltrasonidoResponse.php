<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UltrasonidoResponse extends JsonResource
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
            'paciente' => new UserResponse($this->whenLoaded('paciente')),
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'fecha_creacion' => $this->created_at,
            'media' => MediaResponse::collection($this->multimedias),
        ];
    }
}
