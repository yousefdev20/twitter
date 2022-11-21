<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('followers', FollowerController::class);
    Route::resource('tweets', TweetController::class);

    Route::group(['prefix' => 'tweet'], function () {
        Route::delete('unlike/{tweet}', [TweetController::class, 'unlike']);
        Route::post('like/{tweet}', [TweetController::class, 'like']);
        Route::get('liked', [TweetController::class, 'likedTweets']);
    });

    Route::resource('users', UserController::class);
});
