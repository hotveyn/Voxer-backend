<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultantRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "first_name"=>["required", "string"],
            "last_name"=>["required", "string"],
            "father_name"=>["string"],
            "phone"=>["required", "string"],
            "email"=>["required", "string"],
            "password"=>["required", "string"],
        ];
    }
}
