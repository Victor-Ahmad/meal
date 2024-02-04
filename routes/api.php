<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Address\AddressController;
use App\Http\Controllers\API\Category\CategoryController;
use App\Http\Controllers\API\Home\HomeController;
use App\Http\Controllers\API\Product\ProductController;

use App\Models\Category;
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

Route::middleware('localization')->group(function () {
    Route::post('/request_otp', [AuthController::class, 'requestOTP']);
    Route::post('/verify_otp', [AuthController::class, 'verifyOTP']);
    Route::get('/home', [HomeController::class, 'home']);
    Route::get('/category/{id}', [CategoryController::class, 'getCategory']);
    Route::get('/products/subcategory/{subCategoryId}', [ProductController::class, 'getProductsBySubcategory']);
    Route::get('/products/{productId}', [ProductController::class, 'getProductById']);
});

Route::middleware('auth:sanctum', 'localization')->group(function () {
    Route::post('/submit_name', [AuthController::class, 'submitName']);
    Route::get('/user_info', [AuthController::class, 'userInfo']);
    Route::get('/addresses', [AddressController::class, 'getAddresses']);
    Route::post('/addresses.add', [AddressController::class, 'addAddress']);
    Route::post('/addresses.edit/{id}', [AddressController::class, 'editAddress']);
    Route::get('/addresses.delete/{id}', [AddressController::class, 'deleteAddress']);
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
