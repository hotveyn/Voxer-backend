<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ConsultationRequestController;
use App\Http\Controllers\ConsultationReviewController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\QuestionCategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use App\Models\QuestionCategory;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix("auth")->group(function () {
    Route::post("login", [UserController::class, "login"]);

    Route::middleware("auth:api")->group(function () {
        Route::post("logout", [UserController::class, "logout"]);
    });
});


Route::prefix("regions")->group(function () {
    Route::get("", [RegionController::class, "index"]);
    Route::get("/{region}/organizations", [OrganizationController::class, "info"]);
    Route::get("/{region}/organizations/{organization}/consultants", [UserController::class, "consultantInfo"]);

    Route::middleware(["admin", "auth:api"])->group(function () {

        Route::post("", [RegionController::class, "store"]);
        Route::put("/{region}", [RegionController::class, "update"]);
        Route::delete("/{region}", [RegionController::class, "delete"]);

        Route::prefix('/{region}/organizations')->group(function () {

            Route::post("", [OrganizationController::class, "store"]);
            Route::put("{organization}", [OrganizationController::class, "update"]);
            Route::delete("{organization}", [OrganizationController::class, "delete"]);

            Route::prefix("/{organization}/consultants")->group(function () {
                Route::get("", [UserController::class, "consultantInfo"]);
                Route::post("", [UserController::class, "consultantStore"]);
                Route::put("{consultant}", [UserController::class, "consultantUpdate"]);
                Route::delete("{consultant}", [UserController::class, "consultantDelete"]);
            });
        });
    });
});


Route::prefix("categories")->group(function () {
    Route::get("", [QuestionCategoryController::class, "index"]);
    Route::get("/{category}/problems", [QuestionController::class, "index"]);

    Route::middleware(["admin", "auth:api"])->group(function () {
        Route::post("", [QuestionCategoryController::class, "store"]);
        Route::delete("/{category}", [QuestionCategoryController::class, "delete"]);
        Route::get("/{category}/problems/{problem}", [QuestionController::class, "update"]);
        Route::delete("/{category}/problems/{problem}", [QuestionController::class, "delete"]);
    });
});

Route::prefix("consultations")->group(function () {
    Route::middleware("auth:api")->group(function () {
        Route::get("", [ConsultationController::class, 'index']);
        Route::post("", [ConsultationController::class, 'store']);
        Route::get("{consultation}", [ConsultationController::class, 'indexOne']);


        //todo спросить у сани
        Route::middleware("consultant")->group(function () {
            Route::patch("{consultation}", [ConsultationRequestController::class, "update"]);
        });
        Route::middleware("parent")->group(function () {
            Route::patch("{consultation}", [ConsultationReviewController::class, "update"]);
        });
    });
});
