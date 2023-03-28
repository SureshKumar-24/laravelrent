<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([], function () {
    Route::post('/register', [UserController::class, 'registeruser']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/send-verify-email/{email}', [UserController::class, 'verifymail']);
    Route::post('/forgot', [UserController::class, 'forgot']);
    Route::get('/resetPassword', [UserController::class, 'resetPasswordView']);
    Route::post('/resetpassword', [UserController::class, 'resetPassword']);
});
Route::group([], function () {
    Route::post('/amenity', [AmenityController::class, 'amenityUpload']);
    Route::post('/image', [ImageController::class, 'imageUpload']);
});
