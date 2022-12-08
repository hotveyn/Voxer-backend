<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Http\Requests\RegionStoreRequest;
use App\Models\Organization;
use App\Models\Region;
use App\Services\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function PHPUnit\Framework\isNull;

class RegionController extends Controller
{
    public function index(): Response|Application|ResponseFactory
    {
        return ResponseService::success([Region::all()]);
    }

    public function store(RegionStoreRequest $request): Response|Application|ResponseFactory
    {
        $region = Region::create($request->validated());

        return ResponseService::success([$region]);
    }

    public function update(RegionStoreRequest $request, Region $region): Response|Application|ResponseFactory
    {
        $region->update($request->validated());

        return ResponseService::success([$region]);
        //todo: Хантинг ошибки ненахода
    }

    public function delete(Region $region): Response|Application|ResponseFactory
    {
        if (!$region->companies->count()) {
            $region->delete();
            return ResponseService::success($region);
        } else {
            return ResponseService::error("Регион содержит компанию");
        }
        //todo: Хантинг ошибки ненахода
    }

}
