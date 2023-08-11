<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\DashboradController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
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

// Front end Routes
Route::get('/home', [FrontController::class, 'categories'])->name('home');
Route::get('/category/{id}', [FrontController::class, 'categoryProducts'])->name('products');
Route::get('/product/{id}', [FrontController::class, 'ProductDetail'])->name('product_detail');
Route::Post('/product-comment', [FrontController::class, 'postProductComment'])->name('products.comment');

//end front end routes

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::middleware('auth')->group(function () {
    // categories and products views
    Route::get('/product', function () {
        return view('products.index');
    })->name('product');
    Route::get('/category', function () {
        return view('category.index');
    })->name('category');
    //create and edit routes for products and categories
    Route::resource('products', ProductController::class)->except('index','update');
    Route::post('update-product', [ProductController::class,'updateProduct']);
    Route::resource('categories', CategoryController::class)->except('index');
    //Routes for data-tables
    Route::get('/product-data', [ProductController::class, 'products'])->name('products.data');
    Route::get('/category-data', [CategoryController::class, 'category'])->name('category.data');
    //Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
