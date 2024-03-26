<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class MediaResponse extends JsonResource
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
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'analisis' => new AnalisisResponse($this->whenLoaded('analisis')),
            'tipo' => $this->tipo,
            'url' => Storage::disk($this->disk)->url($this->url),
        ];
    }
}
