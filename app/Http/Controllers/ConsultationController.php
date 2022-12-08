<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationStoreRequest;
use App\Http\Resources\ConsultantResource;
use App\Http\Resources\ConsultationResource;
use App\Models\Children;
use App\Models\Consultation;
use App\Models\ConsultationRequest;
use App\Models\ConsultationReview;
use App\Models\Organization;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\Region;
use App\Models\User;
use App\Services\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConsultationController extends Controller
{
    public static function index(): Response|Application|ResponseFactory
    {
        $user = auth()->user();
        switch ($user->type_id) {
            case 3:
                return ResponseService::success(["consultations" => ConsultationResource::collection(Consultation::all())]);
            case 2:
                return ResponseService::success(["consultations" => ConsultationResource::collection($user->consultations)]);
        }

        return ResponseService::error("Нет доступа");
    }

    public static function indexOne(Consultation $consultation): Response|Application|ResponseFactory
    {
        $user = auth()->user();

        switch ($user->type_id) {
            case 3:
                return ResponseService::success(ConsultationResource::make($consultation));
            case 2:
                $consultation = $user->consultations->where("id", $consultation->id)->first();
                if ($consultation->exists()) {
                    return ResponseService::success(ConsultationResource::make($consultation));
                }
                return ResponseService::error("Эта консультация не пренадлежит данному консультанту");
        }

        return ResponseService::error("Нет доступа");
    }

    public static function store(ConsultationStoreRequest $request): Response|Application|ResponseFactory
    {
        $region = Region::find($request->region_id);
        $organization = Organization::find($request->organization_id);
        $questionCategory = QuestionCategory::find($request->category_id);
        $question = Question::find($request->problem_id);
        $consultant = User::find($request->consultant_id);
        $kid = Children::find($request->kid);

        $can = ($region->organization->where("id", $organization->id)->count() > 0) &&
            ($organization->users->where("id", $consultant->id)->count() > 0) &&
            ($consultant->questionCategory->questions->where("id", $question->id)->count() > 0);

        if ($can) {
            $consultation = Consultation::create([
                "children_id" => $kid->id,
                "question_id" => $question->id,
                "user_id" => $consultant->id,
            ]);
            ConsultationRequest::create([
                "status_id" => 1,
                "need_date" => $request->date,
                "consultation_id" => $consultation->id
            ]);
            ConsultationReview::factory(1)->create([
                "consultation_id" => $consultation->id,
                "code" => $consultation->id + 100000
            ]);
            return ResponseService::success(ConsultationResource::make($consultation));
        }
        return ResponseService::error("Введённые данные неправильны");
    }
}
