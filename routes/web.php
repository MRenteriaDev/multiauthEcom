<?php

use App\Http\Controllers\Admin\Brand\BrandController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\CouponController;
use App\Http\Controllers\Admin\Category\SubCategoryCcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
    return view('frontend.index');
})->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// CATEGORIES ROUTES
Route::get('category/all', [CategoryController::class, 'index'])->name('category.index');
Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');


// BRAND ROUTES
Route::get('brand/all', [BrandController::class, 'index'])->name('brand.index');
Route::get('brand/create', [BrandController::class, 'create'])->name('brand.create');
Route::post('brand/store', [BrandController::class, 'store'])->name('brand.store');
Route::get('brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
Route::post('brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
Route::get('brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');

// SubCategories Routes
Route::get('subcategory/all', [SubCategoryCcontroller::class, 'index'])->name('subcategory.index');
Route::get('subcategory/create', [SubCategoryCcontroller::class, 'create'])->name('subcategory.create');
Route::post('subcategory/store', [SubCategoryCcontroller::class, 'store'])->name('subcategory.store');
Route::get('subcategory/edit/{id}', [SubCategoryCcontroller::class, 'edit'])->name('subcategory.edit');
Route::post('subcategory/update/{id}', [SubCategoryCcontroller::class, 'update'])->name('subcategory.update');
Route::get('subcategory/delete/{id}', [SubCategoryCcontroller::class, 'delete'])->name('subcategory.delete');

// Coupons Routes
Route::get('coupons/all', [CouponController::class, 'index'])->name('coupon.index');
Route::post('coupons/store', [CouponController::class, 'store'])->name('coupon.store');
Route::get('coupon/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
Route::post('coupon/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
Route::get('coupon/delete/{id}', [CouponController::class, 'delete'])->name('coupon.delete');

