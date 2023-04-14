<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProductVariantController;

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


// Photos
Route::get('photos/product/{product}', [PhotoController::class, 'create'])->name('photos.create');
Route::post('photos/store', [PhotoController::class, 'store'])->name('photos.store');
Route::post('photos/uploadPhotos', [PhotoController::class, 'uploadPhotos'])->name('products.uploadPhotos');
Route::delete('photos/destroy/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
Route::patch('photos/makePhotoPrimary/{product}/{photo}', [PhotoController::class, 'makePhotoPrimary'])->name('photos.makePhotoPrimary');

// Files
Route::get('files/product/{product}', [FileController::class, 'create'])->name('files.create');
Route::post('files/store', [FileController::class, 'store'])->name('files.store');
Route::get('files/download/{file}', [FileController::class, 'download'])->name('files.download');
Route::delete('files/destroy/{file}', [FileController::class, 'destroy'])->name('files.destroy');
Route::patch('files/rename/{file}', [FileController::class, 'rename'])->name('files.rename');

// Product Variants
Route::get('productVariants/{product}', [ProductVariantController::class, 'create'])->name('productVariants.create');
Route::post('productVariants/{product}', [ProductVariantController::class, 'store'])->name('productVariants.store');
Route::delete('productVariants/{productVariant}', [ProductVariantController::class, 'destroy'])->name('productVariants.destroy');

Route::get('productVariants/{productVariant}/edit', [ProductVariantController::class, 'edit'])->name('productVariants.edit');

Route::put('productVariants/{productVariant}', [ProductVariantController::class, 'update'])->name('productVariants.update');