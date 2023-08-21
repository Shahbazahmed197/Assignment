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
// Front end Routes
Route::resource('web-category', WebCategoryController::class)->only(['index','show']);
Route::resource('web-product', WebProductController::class)->only('show');
Route::resource('comment', CommentController::class)->only('store')->middleware('auth');

Route::middleware(['role:admin'])->group(function () {
    Route::get('/dashboard', [DashboradController::class,'dashboard'])->name('dashboard');

    //CRUD routes for products and categories
    Route::resource('products', ProductController::class);
    Route::post('update-product', [ProductController::class,'updateProduct']);
    Route::resource('categories', CategoryController::class);

    //Profile Routes
    Route::resource('profile', ProfileController::class);
    Route::resource('setting', SettingController::class);
    //Routes for data-tables
    Route::get('/product-data', [ProductController::class, 'products'])->name('products.data');
    Route::get('/category-data', [CategoryController::class, 'category'])->name('category.data');
});

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__ . '/auth.php';
