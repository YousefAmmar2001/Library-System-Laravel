<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPermissionController;
use App\Mail\WelcomeEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::prefix('cms')->middleware('guest:admin,user')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('cms.login')->where('guard', 'admin|user');
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('cms/admin')->middleware(['auth:admin', 'verified'])->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('permissions/role', RolePermissionController::class);
    Route::resource('permissions/user', UserPermissionController::class);
});

Route::prefix('cms/admin')->middleware(['auth:admin,user', 'verified'])->group(function () {
    Route::view('/', 'cms.empty')->name('home');
    Route::resource('categories', CategoryController::class);
    Route::put('books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
    Route::resource('books', BookController::class);
    Route::resource('countries', CountryController::class);
    Route::get('change-password', [AuthController::class, 'showChangePassword'])->name('cms.change-password');
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');
});

// Route::prefix('mail')->group(function () {
//     Route::get('welcome', function () {
//         return new WelcomeEmail();
//     });
// });

Route::get('/email/verify', function () {
    return view('cms.auth.verify-email');
})->middleware('auth:admin,user')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/cms/admin');
})->middleware(['auth:admin,user', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Verification link sent!']);
    // return back()->with('message', 'Verification link sent!');
})->middleware(['auth:admin,user', 'throttle:2,1'])->name('verification.send');

Route::fallback(function () {
    if (auth('admin')->check() || auth('user')->check()) {
        return redirect()->route('home');
    }
    return response()->view('cms.404');
});
