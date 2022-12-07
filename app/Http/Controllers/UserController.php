<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
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
}
