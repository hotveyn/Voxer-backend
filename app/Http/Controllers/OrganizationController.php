<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use App\Models\Region;
use App\Services\ResponseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrganizationController extends Controller
{


    public function info(Region $region): Response|Application|ResponseFactory
    {
        return ResponseService::success([$region->organization]);
        //todo: Хантинг ошибки ненахода
    }

    public function store(OrganizationRequest $request, Region $region): Response|Application|ResponseFactory
    {
        $organization = Organization::create(
            ["name" => $request->name, "region_id" => $region->id]
        );

        return ResponseService::success([$organization]);
    }

    public function update(OrganizationRequest $request, Region $region, Organization $organization): Response|Application|ResponseFactory
    {
        $organization->update($request->validated());

        return ResponseService::success([$organization]);
    }

    public function delete(Region $region, Organization $organization): Response|Application|ResponseFactory
    {
        if (!$organization->consultants->count) {
            $organization->delete();
            return ResponseService::success();
        }

        return ResponseService::error("Организация содержит консультантов");
    }
}
