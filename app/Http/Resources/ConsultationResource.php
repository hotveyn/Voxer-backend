<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "kid" => ChildrenResource::make($this->children),
            "question" => QuestionResource::make($this->question),
            "consultant" => ConsultantResource::make($this->user),
            "review" => $this->ConsultationReview,
            "request" => ConsultationRequestResource::make($this->ConsultationRequest),
        ];
    }
}
