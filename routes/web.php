<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use Facade\FlareClient\View;
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

// Route::fallback(function () {
//     return view('cms.404');
// });

Route::prefix('cms')->middleware('guest:admin,user')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('cms.login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('countries', CountryController::class);
});

Route::prefix('cms/admin')->middleware('auth:admin,user')->group(function () {
    Route::view('/', 'cms.empty')->name('home');
    Route::resource('books', BookController::class);
    Route::get('change-password', [AuthController::class, 'showChangePassword'])->name('cms.change-password');
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');
});
