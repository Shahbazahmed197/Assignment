<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboradController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Web\CategoryController as WebCategoryController;
use App\Http\Controllers\Web\CommentController;
use App\Http\Controllers\Web\ProductController as WebProductController;
use Illuminate\Support\Facades\Route;

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
})->name('welcome');
Route::post('/images/upload',  [ProductController::class, 'uploadImage'])->name('images.upload');
Route::delete('/images/remove', [ProductController::class, 'removeImage'])->name('remove.image');

// Front end Routes
Route::middleware('checkemail')->group(function () {
    Route::resource('web-category', WebCategoryController::class)->only(['index', 'show']);
    Route::resource('web-product', WebProductController::class)->only('show');
    Route::resource('comment', CommentController::class)->only('store')->middleware('auth');
});

//dashboard routes
Route::middleware(['verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboradController::class, 'dashboard'])->name('dashboard');

    //CRUD routes for products and categories
    Route::resource('products', ProductController::class);
    Route::post('update-product', [ProductController::class, 'updateProduct']);
    Route::resource('categories', CategoryController::class);

    //Routes for data-tables
    Route::get('/product-data', [ProductController::class, 'products'])->name('products.data');
    Route::get('/category-data', [CategoryController::class, 'category'])->name('category.data');
});
//Profile Routes
Route::middleware('auth')->group(function () {
    Route::resource('profile', ProfileController::class);
    Route::resource('setting', SettingController::class);
    Route::post('/profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('picture.update');
});

require __DIR__ . '/auth.php';
