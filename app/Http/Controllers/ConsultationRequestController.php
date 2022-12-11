<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationRequestUpdateRequest;
use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;
use App\Models\Status;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class ConsultationRequestController extends Controller
{
    public static function update(ConsultationRequestUpdateRequest $request, Consultation $consultation)
    {
        $date = $request->date;
        $reason = $request->reason;
        $result = $request->result;

        if ($date === "null") $date = null;
        if ($reason === "null") $reason = null;
        if ($result === "null") $result = null;

        $consultationRequest = $consultation->consultationRequest;
        $status = Status::where("status", $request->status)->first();
        if ($status) {
            $consultationRequest->update([
                "status_id"=>$status->id,
                "date"=>$date,
                "reason"=>$reason,
                "result"=>$result
            ]);
            return ResponseService::success(ConsultationResource::make($consultation));
        }
        return ResponseService::error("Введены неправельные данные");
    }
}
