<?php

namespace App\Http\Resources;

use App\Models\Children;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "status"=>StatusResource::make($this->status),
            "date"=>$this->date,
            "need_date"=>$this->need_date,
            "description"=>$this->description,
            "reason"=>$this->reason,
            "result"=>$this->result,
        ];
    }
}
