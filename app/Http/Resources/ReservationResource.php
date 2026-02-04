<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TableResource;

class ReservationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
           'id'=>$this->id,
           'first_name'=>$this->first_name,
           'last_name'=>$this->last_name,
           'email'=>$this->email,
           'tel_number'=>$this->tel_number,
           'res_date'=>$this->res_date,
           'guest_number'=>$this->guest_number,
           'table_id'=>$this->table_id,
           'table' => new TableResource($this->whenLoaded('table')),
           'created_at'=>$this->created_at,
        ];
    }
}
