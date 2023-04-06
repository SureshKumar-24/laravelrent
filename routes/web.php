<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/verify-mail/{token}', [UserController::class, 'verificationmail']);
Route::get('/reset-password', [UserController::class, 'resetPasswordView']);
Route::Post('/reset-password', [UserController::class, 'resetPassword']);
Route::get('pdf/view',[PropertyController::class,'pdfView'])->name('pdf.view');
Route::get('pdf/convert',[PropertyController::class,'pdfConvert'])->name('pdf.convert');
