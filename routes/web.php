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
use App\Http\Controllers\CountryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
use App\Models\User;

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

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
	// Admin Routes
	Route::group(['middleware' => 'is_active_admin', 'prefix' => 'admin'], function(){
		// Categories
		Route::resource('categories', CategoryController::class);
		Route::patch('categories/{category}/toggleStatus', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');

		// Subcategories
		Route::resource('subcategories', SubcategoryController::class);

		// Products
		Route::resource('products', ProductController::class);
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

		// Dashboard Admin
		Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

		// Users
		Route::get('settings', [UserController::class, 'editSettings'])->name('settings.edit');
		Route::resource('users', UserController::class);
		Route::patch('users/{user}/toggleActive', [UserController::class, 'toggleActive'])->name('users.toggleActive');

		// Countries
		Route::resource('countries', CountryController::class)->except(['edit', 'show']);

		// Orders
		Route::resource('orders', OrderController::class)->except(['create', 'store', 'edit', 'destroy']);
		Route::patch('orders/{order}/changeOrderStatus', [OrderController::class, 'changeOrderStatus'])->name('orders.changeOrderStatus');

		// Sliders
		Route::resource('sliders', SliderController::class)->except('show');

		// Our Collection
		Route::get('ourCollection', [SliderController::class, 'ourCollection'])->name('ourCollection');
		Route::get('createCollection', [SliderController::class, 'createCollection'])->name('createCollection');
		Route::post('storeCollection', [SliderController::class, 'storeCollection'])->name('storeCollection');
		Route::get('editCollection/{ourCollection}', [SliderController::class, 'editCollection'])->name('editCollection');
		Route::put('updateCollection/{ourCollection}', [SliderController::class, 'updateCollection'])->name('updateCollection');
		Route::delete('deleteCollection/{ourCollection}', [SliderController::class, 'deleteCollection'])->name('deleteCollection');
	});

	// User
	Route::put('settings', [UserController::class, 'updateSettings'])->name('settings.update');

	// Auth (account suspended)
	Route::view('account-suspended', 'auth.banned')->name('suspended');


	// Customer Routes
	Route::group(['prefix' => 'customer'], function(){
		// Dashboard Customer
		Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
		Route::resource('addresses', AddressController::class)->only(['store', 'update']);

	});
	
	// Shopping Cart
	Route::post('/addToShoppingCart', [StoreController::class, 'addToShoppingCart'])->name('addToShoppingCart');	
	Route::patch('/updateShoppingCart', [StoreController::class, 'updateShoppingCart'])->name('updateShoppingCart');
	Route::delete('/removeProductFromShoppingCart/{product}', [StoreController::class, 'removeProductFromShoppingCart']);
	Route::delete('/clearAllShoppingCart', [StoreController::class, 'clearAllShoppingCart']);
	Route::view('/showShoppingCart', 'app.customer.cart')->name('myShoppingCart');


	// Place Order
	Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
	Route::patch('orders/{order}/cancelOrder', [OrderController::class, 'cancelOrder'])->name('cancelOrder');

	// Coupon
	Route::get('coupons/{coupon:code}/checkCoupon', [CouponController::Class, 'checkCoupon']);

	// Review
	Route::resource('reviews', ReviewController::class)->except(['index', 'create', 'edit', 'update', 'show']);
});

// Public Pages
Route::get('/', [StoreController::class, 'index'])->name('index');
Route::view('/wishlist', 'app.customer.wishlist')->name('wishlist');
Route::get('/shop/{category?}/{criteria?}/{minPrice?}/{maxPrice?}', [StoreController::class, 'shop'])->name('shop');
Route::get('/productDetails/{product}', [StoreController::class, 'productDetails'])->name('productDetails');


// Lock Screen
Route::get('/lock-screen', [LockScreen::class, 'lock'])->name('screen.lock');
Route::post('/unlock-screen', [LockScreen::class, 'unlock'])->name('screen.unlock');


// Generate New CSRF
Route::get('/refresh-csrf-token', function() {
    return csrf_token();
});


