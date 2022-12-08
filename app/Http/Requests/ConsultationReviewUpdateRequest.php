<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationReviewUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email"=>["required","string"],
            "code"=>["required","integer"],
            "rating"=>["required","integer", "max:5", "min:1"],
        ];
    }
}
