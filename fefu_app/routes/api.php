<?php


use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\AppealApiController;
use App\Http\Controllers\Api\CategoriesApiController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\PageAppiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CartApiController;
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

Route::apiResource('categories', CategoriesApiController::class)->only([
    'index',
    'show',
]);

Route::prefix('catalog')->group(function () {
    Route::get('product/list', [ProductApiController::class, 'index']);
    Route::get('product/details', [ProductApiController::class, 'show']);
});

Route::prefix('cart')->middleware('auth.optional:sanctum')->group(function () {
    Route::post('set_quantity', [CartApiController::class, 'setQuantity']);
    Route::get('show', [CartApiController::class, 'show']);
});

Route::post('/order/store', [ OrderApiController::class, 'store']);