<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationReviewUpdateRequest;
use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class ConsultationReviewController extends Controller
{
    public static function update(ConsultationReviewUpdateRequest $request, Consultation $consultation)
    {
        $consultationReview = $consultation->consultationReview;

        if($consultationReview->code == $request->code){
            $consultationReview->update([
                "rate" => $request->rating
            ]);
            return ResponseService::success(ConsultationResource::make($consultation));
        }

        return ResponseService::error("Неверный код");
    }
}
