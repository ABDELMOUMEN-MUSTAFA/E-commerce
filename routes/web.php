<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('app.products.index');
});


// Categories
Route::resource('categories', CategoryController::class);
Route::patch('categories/{category}/toggleStatus', [CategoryController::class, 'toggleStatus'])->name('toggleStatus');

// Subcategories
Route::resource('subcategories', SubcategoryController::class);

// Products
Route::resource('products', ProductController::class);
Route::patch('products/{product}/toggleActive', [ProductController::class, 'toggleActive'])->name('products.toggleActive');
Route::patch('products/{product}/incrementStock', [ProductController::class, 'incrementStock'])->name('products.incrementStock');