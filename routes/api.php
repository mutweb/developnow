<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

/** Product Category */
use App\Http\Controllers\Api\ProductCategoryController;
Route::controller(ProductCategoryController::class)->name('api.productCategory.')->group(function () {
	Route::get('productCategory', 'index')->name('index');
	Route::get('productCategory/{productCategory}', 'show')->name('show');
	Route::post('productCategory', 'store')->name('store');
	Route::put('productCategory/{productCategory}', 'update')->name('update');
	Route::delete('productCategory/{productCategory}', 'delete')->name('delete');
});

/** Product */
use App\Http\Controllers\Api\ProductController;
Route::controller(ProductController::class)->name('api.product.')->group(function () {
	Route::get('product', 'index')->name('index');
	Route::get('product/{product}', 'show')->name('show');
	Route::post('product', 'store')->name('store');
	Route::post('product/{product}', 'update')->name('update');
	Route::delete('product/{product}', 'delete')->name('delete');
});

/** Cart Item */
use App\Http\Controllers\Api\CartItemController;
Route::controller(CartItemController::class)->name('api.cartItem.')->group(function () {
	Route::get('cartItem', 'index')->name('index');
	Route::get('cartItem/{cartItem}', 'show')->name('show');
	Route::post('cartItem', 'store')->name('store');
	Route::put('cartItem/{cartItem}', 'update')->name('update');
	Route::delete('cartItem/{cartItem}', 'delete')->name('delete');
});