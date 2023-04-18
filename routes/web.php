<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LockScreen;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Str;
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

// Dashboard
Route::get('/', function () {
    return view('auth.login');
})->name('index');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
	Route::group(['middleware' => 'is_admin', 'prefix' => 'admin'], function(){
		// Categories
		Route::resource('categories', CategoryController::class);
		Route::patch('categories/{category}/toggleStatus', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');

		// Subcategories
		Route::resource('subcategories', SubcategoryController::class);

		// Products
		Route::resource('products', ProductController::class)->middleware('is_admin');
		Route::patch('products/{product}/toggleActive', [ProductController::class, 'toggleActive'])->name('products.toggleActive');
		Route::patch('products/{product}/incrementStock', [ProductController::class, 'incrementStock'])->name('products.incrementStock');
		Route::get('products/search/name', [ProductController::class, 'search'])->name('products.search');

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

		// Sizes
		Route::resource('sizes', SizeController::class);

		// Colors
		Route::resource('colors', ColorController::class);

		// Product Variants
		Route::get('productVariants/{product}', [ProductVariantController::class, 'create'])->name('productVariants.create');
		Route::post('productVariants/{product}', [ProductVariantController::class, 'store'])->name('productVariants.store');
		Route::delete('productVariants/{productVariant}', [ProductVariantController::class, 'destroy'])->name('productVariants.destroy');
		Route::get('productVariants/{productVariant}/edit', [ProductVariantController::class, 'edit'])->name('productVariants.edit');
		Route::put('productVariants/{productVariant}', [ProductVariantController::class, 'update'])->name('productVariants.update');

		// Coupons
		Route::resource('coupons', CouponController::class);
		Route::patch('coupons/{coupon}/toggleStatus', [CouponController::class, 'toggleStatus'])->name('coupons.toggleStatus');

		// Promotions
		Route::get('promotions/{product}', [PromotionController::class, 'create'])->name('promotions.create');
		Route::post('promotions/{product}', [PromotionController::class, 'store'])->name('promotions.store');
		Route::delete('promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.destroy');
		Route::get('promotions/{promotion}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
		Route::put('promotions/{promotion}', [PromotionController::class, 'update'])->name('promotions.update');
		Route::delete('promotions/{product}/clearExpired', [PromotionController::class, 'clearExpired'])->name('promotions.clearExpired');

		Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

		Route::get('settings', [UserController::class, 'editSettings'])->name('settings.edit');
		Route::put('settings', [UserController::class, 'updateSettings'])->name('settings.update');

	});

});

// Lock Screen
Route::get('/lock-screen', [LockScreen::class, 'lock'])->name('screen.lock');
Route::post('/unlock-screen', [LockScreen::class, 'unlock'])->name('screen.unlock');


Route::get('/refresh-csrf-token', function() {
    return csrf_token();
});


