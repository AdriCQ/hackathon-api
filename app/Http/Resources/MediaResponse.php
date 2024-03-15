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
            'name' => $this->name,
            'description' => $this->description,
            'user' => new UserResponse($this->whenLoaded('user')),
            'type' => $this->type,
            'url' => filter_var($this->url, FILTER_VALIDATE_URL)
                ? $this->url
                : Storage::disk($this->disk)->url($this->path),
        ];
    }
}
