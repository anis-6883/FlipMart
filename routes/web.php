<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
})->name('home');

Route::get('/register', [UserController::class, 'create'])->name('user.create')->middleware('guest');
Route::post('/register', [UserController::class, 'store'])->name('user.store')->middleware('guest');
Route::get('/login', [SessionController::class, 'login'])->name('user.login')->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->name('user.authenticate')->middleware('guest');
Route::post('/logout', [SessionController::class, 'destroy'])->name('user.logout')->middleware('auth');
Route::get('/verification/{random_token}', [SessionController::class, 'email_verify'])->name('user.verify');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::group(['middleware' => 'admin_auth'], function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/categoryUpdateStatus', [AjaxController::class, 'categoryUpdateStatus'])->name('category.updateStatus');
    Route::post('/subcategoryUpdateStatus', [AjaxController::class, 'subcategoryUpdateStatus'])->name('subcategory.updateStatus');
    Route::post('/productUpdateStatus', [AjaxController::class, 'productUpdateStatus'])->name('product.updateStatus');
    Route::post('/couponUpdateStatus', [AjaxController::class, 'couponUpdateStatus'])->name('coupon.updateStatus');
    Route::post('/customerUpdateStatus', [AjaxController::class, 'customerUpdateStatus'])->name('customer.updateStatus');
    Route::post('/loadSubcategory', [AjaxController::class, 'loadSubcategory'])->name('product.loadSubcategory');
    Route::post('/loadSeletedSubcategory', [AjaxController::class, 'loadSeletedSubcategory'])->name('product.loadSeletedSubcategory');
    Route::resource('/admin/category', CategoryController::class);
    Route::resource('/admin/subcategory', SubcategoryController::class);
    Route::resource('/admin/product', ProductController::class);
    Route::resource('/admin/product-images', ProductImageController::class);
    Route::resource('/admin/coupon', CouponController::class);
    Route::resource('/admin/customer', CustomerController::class);
});
