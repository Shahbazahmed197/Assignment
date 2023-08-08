<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\UserController;
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
Route::post('/register',[UserController::class, 'register']);
Route::post('/login',[UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('category',CategoryController::class);
    Route::resource('product', ProductController::class);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth')->post('/create-api-token', function (Request $request) {
    $user = $request->user();
    $token = $user->createToken('api-token')->plainTextToken;
    return ['token' => $token];
});
