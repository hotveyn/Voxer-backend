<?php

namespace App\Services;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ResponseService
{
    public static function success(mixed $data = [], int $code = 200): Response|Application|ResponseFactory
    {
        if(count($data) !== 0){
            return response([
                "data" => $data,
                "status" => "ok"
            ], $code);
        }
        return response([
            "status" => "ok"
        ], $code);
    }

    public static function error(mixed $message, int $code = 404): Response|Application|ResponseFactory
    {
        return response([
            "data" => [
                "error"=> $message
            ],
            "status" => "error"
        ], $code);
    }
}
