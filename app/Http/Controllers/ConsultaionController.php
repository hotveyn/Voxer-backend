<?php

namespace App\Http\Controllers;

use App\Models\Consultaion;
use App\Models\ConsultaionRequest;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class ConsultaionController extends Controller
{
    public static function index()
    {
        $user = auth()->user();
        switch ($user->type_id ){
            case 3:
                return ResponseService::success(Consultaion::all());
            case 2:
                return ResponseService::success($user->consultations);
        }
    }

    public static function create()
    {

    }
}
