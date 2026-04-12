<?php

use App\Http\Controllers\API\ApiAuthController;
use App\Http\Controllers\API\BookController;
// use App\Http\Controllers\BookController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function () {
    Route::post('login', [ApiAuthController::class, 'login']);
});

Route::prefix('auth')->middleware('auth:api')->group(function () {
    Route::get('logout', [ApiAuthController::class, 'logout']);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('books', BookController::class);
    // Route::apiResource('books', BookController::class);
});
