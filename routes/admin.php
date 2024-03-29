<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('user', UserController::class);
    Route::resource('address', AddressController::class);
    Route::resource('driver', DriverController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('company', CompanyController::class);
    Route::resource('orderStatus', OrderStatusController::class);
    Route::resource('orders', OrderController::class);
    Route::get('/showMap/{id}', [OrderController::class, 'showMap'])->name('showOrderMap');
    Route::get('/showAddressMap/{id}', [AddressController::class, 'showMap'])->name('showAddressMap');
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('collection', CollectionController::class);
    Route::resource('product', ProductController::class);
    Route::resource('offer', OfferController::class);
    Route::get('/get/subcategory', [ProductController::class, 'getsubcategory'])->name('getsubcategory');
    Route::get('/remove-external-img/{id}', [ProductController::class, 'removeImage'])->name('remove.image');
});
