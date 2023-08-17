<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PasswordController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('/forgot-password',[PasswordController::class, 'forgotPassword']);

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('category',CategoryController::class)->only('index');
    Route::resource('product', ProductController::class)->only('index');
    Route::resource('profile', ProfileController::class)->only('show','update','destroy');

    Route::post('/update-password',[PasswordController::class, 'updatePassword']);
    Route::post('/logout',[AuthController::class, 'logout']);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
