<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantResource extends JsonResource
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
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "father_name" => $this->father_name,
            "email" => $this->email,
            "phone" => $this->phone,
            "question_category" => QuestionCategoryResource::make($this->questionCategory),
            "organization" => OrganizationResource::make($this->organization),
            "password" => $this->password,
            "api_token" => $this->api_token,
        ];
    }
}
