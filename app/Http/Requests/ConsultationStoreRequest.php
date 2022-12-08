<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "first_name" => ["required", "string"],
            "last_name" => ["required", "string"],
            "father_name" => [ "string"],
            "email" => ["required", "string"],
            "kid" => ["required", "integer"],
            "age" => ["required", "integer"],
            "region_id" => ["required", "integer"],
            "organization_id" => ["required", "integer"],
            "category_id" => ["required", "integer"],
            "problem_id" => ["required", "integer"],
            "consultant_id" => ["required", "integer"],
            "date" => ["required", "date"]
        ];
    }
}
