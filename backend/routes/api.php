<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactInformationController;

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

// Contact Information
Route::apiResource('contact', ContactInformationController::class);

// GYM
Route::apiResource('gym', \App\Http\Controllers\GymController::class);

// User
Route::apiResource('user', \App\Http\Controllers\UserController::class);

// Role
Route::apiResource('role', \App\Http\Controllers\RoleController::class);

// User Role
Route::apiResource('user-role', \App\Http\Controllers\UserRoleController::class);

// Membership
Route::apiResource('membership', \App\Http\Controllers\MembershipController::class);

// Member
Route::apiResource('member', \App\Http\Controllers\MemberController::class);

// Subscription
Route::apiResource('subscription', \App\Http\Controllers\SubscriptionController::class);

// Attendance
Route::apiResource('attendance', \App\Http\Controllers\AttendanceController::class);

// Installation
Route::prefix('install')->group(function () {

    Route::get('', [\App\Http\Controllers\InstallationController::class, 'getInstalledState'])
        ->name('install.getState');

    Route::post('', [\App\Http\Controllers\InstallationController::class, 'setInstalledState'])
        ->name('install.setState');

    Route::post('database', [\App\Http\Controllers\InstallationController::class, 'setupDatabase'])
        ->name('install.database');
});