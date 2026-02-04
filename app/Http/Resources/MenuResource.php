<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;

class MenuResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'description'=> $this->description,
            'image_url' => $this->image ? asset('storage/'.$this->image) : null,
            'price'=> (float) $this->price,
            'status'=> $this->status ?? null,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'created_at'=> $this->created_at,
        ];
    }
}
