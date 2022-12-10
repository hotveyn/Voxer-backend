<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultantRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\Organization;
use App\Models\Region;
use App\Models\User;
use App\Services\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(UserLoginRequest $request): Response|Application|ResponseFactory
    {
        if (auth()->attempt($request->validated())) {
            $user = auth()->user();
            $user->api_token = Str::uuid();
            $user->save();

            return ResponseService::success(["token" => $user->api_token]);
        }

        return ResponseService::error("Ошибка авторизации");
    }

    public function logout(): Response|Application|ResponseFactory
    {
        $user = auth()->user();
        $user->api_token = null;
        $user->save();
        return ResponseService::success();
    }

    public function consultantInfo(Region $region, Organization $organization): Response|Application|ResponseFactory
    {
        return ResponseService::success($organization->consultants);
    }

    public function consultantStore(ConsultantRequest $request, Region $region, Organization $organization): Response|Application|ResponseFactory
    {
        $consultant = User::create([
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "father_name"=>$request->father_name,
            "phone"=>$request->phone,
            "email"=>$request->email,
            "password"=>$request->password,
            "type_id" => 2,
            "organization_id" => $organization->id,
            "question_category_id" => fake()->numberBetween(1,30)
        ]);

        return ResponseService::success($consultant, 201);
    }

    public function consultantUpdate(ConsultantRequest $request, Region $region, Organization $organization, User $consultant): Response|Application|ResponseFactory
    {
        $consultant->update($request->validated());

        return ResponseService::success($consultant);
    }
    public function consultantDelete(Region $region, Organization $organization, User $consultant): Response|Application|ResponseFactory
    {
        $consultant->delete();

        return ResponseService::success($consultant);
    }

    public function index()
    {
//        dd(auth()->user());
//        return response( auth()->user() );
        return ResponseService::success( UserResource::make(auth()->user()));
    }
}
