<?php

use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
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


Route::prefix('v1')->group(function () {
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/', function () {
        return response()->json([
            "status" => "OK",
            "message" => "Rakamin Investree"
        ]);
    });

    Route::post('/registration', [RegisterController::class, 'index']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:api');

    Route::middleware('auth:api')->group(function () {
        Route::apiResources([
            'categories' => CategoryController::class,
            'articles' => ArticleController::class
        ]);
    });
});
