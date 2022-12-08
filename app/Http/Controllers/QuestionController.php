<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Services\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{

    public static function index(QuestionCategory $category): Response|Application|ResponseFactory
    {
        return ResponseService::success($category->questions);
    }

    public static function update(QuestionRequest $request, QuestionCategory $category, Question $problem): Response|Application|ResponseFactory
    {
        $problem = $category->questions->where("id", $problem->id)->first();
        $problem->update($request->validated());

        return ResponseService::success($problem);
    }

    public static function delete(QuestionCategory $category, Question $problem): Response|Application|ResponseFactory
    {
        $question = $category->questions->where("id", $problem->id)->first();

        if(!$question->consultaions->count()){
            $question->delete();
            return ResponseService::success($question);
        }
        return ResponseService::error("Существует заявка по данному вопросу");
    }
}
