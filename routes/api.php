<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\PropertyRoomController;
use App\Http\Controllers\PropertyController;

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
    Route::post('/register', [UserController::class, 'registeruser'])->name('register');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('/send-verify-email/{email}', [UserController::class, 'verifymail']);
    Route::post('/forgot', [UserController::class, 'forgot'])->name('forgot');
    Route::get('/resetPassword', [UserController::class, 'resetPasswordView']);
    Route::post('/resetpassword', [UserController::class, 'resetPassword'])->name('resetForgot');
    Route::get('/getimage', [ImageController::class, 'getImageUpload']);
    Route::get('/getamenity', [AmenityController::class, 'getAmenity']);
    Route::get('/getQuestions', [QuestionController::class, 'getQuestions']);
    Route::get('/getProperty', [PropertyController::class, 'getProperty']);
    Route::get('/getAmenity', [PropertyController::class, 'getAmenity']);
    Route::get('/getQuestion', [PropertyController::class, 'getQuestion']);
    Route::post('/propertyroom', [PropertyRoomController::class, 'roomcontroller']);
    Route::delete('/delete/{id}', [PropertyController::class, 'delete']);
});

// Route::group(['middleware' => 'api' 'isAdmin'], function ($routes) {
Route::group(['middleware' => 'api'], function ($routes) {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/changePassword', [UserController::class, 'changePasswordSave'])->name('changePassword');
    Route::post('/amenity', [AmenityController::class, 'amenityUpload'])->name('amenity');
    Route::post('/image', [ImageController::class, 'imageUpload']);
    Route::post('/questions', [QuestionController::class, 'QuestionController']);
    Route::post('/property', [PropertyController::class, 'Property']);
});
