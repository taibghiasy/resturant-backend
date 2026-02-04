<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TableResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
          'id'=> $this->id,
          'name'=> $this->name,
          'guest_number'=> (int) $this->guest_number,
          'status'=> $this->status?->value ?? $this->status ?? null,
          'location'=> $this->location?->value ?? $this->location ?? null,
          'created_at'=> $this->created_at,
        ];
    }
}
