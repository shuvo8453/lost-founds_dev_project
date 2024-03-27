<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'type' => $this->type,
            'status' => $this->status,
            'created' => $this->updated_at ? $this->created_at->format('d/m/Y') : null,
            'updated' => $this->updated_at ? $this->updated_at->format('d/m/Y') : null,
        ];
    }
}
