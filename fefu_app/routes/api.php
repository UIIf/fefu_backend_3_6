<?php


use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\AppealApiController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\PageAppiController;
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

Route::middleware('auth:sanctum')->get('/user', [AuthApiController::class, 'getUser']);

Route::post('login', [AuthApiController::class, 'login']);

Route::post('register', [AuthApiController::class, 'register']);

Route::post('logout', [AuthApiController::class, 'logout']);

Route::apiResource('appeal', AppealApiController::class)->only([
    'store'
]);

Route::apiResource('news', NewsApiController::class)->only([
    'index',
    'show',
]);

Route::apiResource('page', PageAppiController::class)->only([
    'index',
    'show',
]);