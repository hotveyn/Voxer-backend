<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "first_name" => ["required", "string"],
            "last_name" => ["required", "string"],
            "email" => ["required", "string"],
            "phone" => ["required", "string"],
            "children_id"=> ["required", "integer"],
            "region_id" => ["required", "integer"],
            "organization_id" => ["required", "integer"],
            "question_id" => ["required", "integer"],
            "user_id" => ["required", "integer"],
            "date" => ["required", "date"],
        ];
    }
}
