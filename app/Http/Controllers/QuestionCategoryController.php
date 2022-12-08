<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionCategoryRequest;
use App\Models\QuestionCategory;
use App\Services\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionCategoryController extends Controller
{
    public static function index(): Response|Application|ResponseFactory
    {
        return ResponseService::success(QuestionCategory::all());
    }

    public static function store(QuestionCategoryRequest $request): Response|Application|ResponseFactory
    {
        $questionCategory = QuestionCategory::create($request->validated());

        return ResponseService::success($questionCategory);
    }

    public function delete(QuestionCategory $category): Response|Application|ResponseFactory
    {

        if(!$category->questions->count()){
            $category->delete();
            return ResponseService::success($category);
        }

        return ResponseService::error("Категория содержит вопросы");
    }
}
