<?php

use App\Http\Controllers\Web\OAuthController;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\OrderWebController;
use App\Http\Controllers\Web\AppealWebController;
use App\Http\Controllers\Web\CartWebController;
use App\Http\Controllers\Web\CategoriesWebController;
use App\Http\Controllers\Web\PageWebController;
use App\Http\Controllers\Web\NewsWebController;
use App\Http\Controllers\Web\ProductWebController;
use App\Http\Controllers\Web\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories/{slug?}', [CategoriesWebController::class, 'index'])
    ->name('categories');

Route::resource('news', NewsWebController::class)->only([
    'index',
    'show',
]);

Route::get('/cart', CartWebController::class)->middleware('auth.optional');

Route::get('/profile', [ProfileController::class, 'show'])
    ->name('profile')
    ->middleware('auth');


Route::get('/login', [AuthWebController::class, 'loginForm'])
    ->name('login');

Route::post('/login', [AuthWebController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [AuthWebController::class, 'logout'])
    ->name('logout');

Route::get('/register', [AuthWebController::class, 'registerForm'])
    ->name('register');

Route::post('/register', [AuthWebController::class, 'register'])
    ->name('register.post');

Route::prefix('/oauth')->group(function () {
    Route::get('/{provider}/redirect', [OAuthController::class, 'redirectToService'])->name('oauth.redirect');
    Route::get('/{provider}/login', [OAuthController::class, 'login'])->name('oauth.login');
});

Route::get('/catalog/product/{slug}', [ProductWebController::class, 'index'])
    ->name('product');

Route::get('/appeal', [AppealWebController::class, 'form'])->name('appeal.form');
Route::post('/appeal', [AppealWebController::class, 'send'])->name('appeal.send');


Route::get('/{slug}', [PageWebController::class, 'show']);

Route::get('/checkout', [ OrderWebController::class, 'index'])->middleware('auth')->name('checkout.get');

Route::post('/checkout', [ OrderWebController::class, 'store'])->middleware('auth')->name('checkout.post');